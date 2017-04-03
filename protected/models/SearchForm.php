<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SearchForm extends CFormModel {
  public $dateRange;
  public $startDate;
  public $endDate;
  public $noOfRooms;
  public $rooms;
  public $searchRooms;
  public $bookedRooms;
  public $is_bookable;
  public $total_booking_price;
  public $book_button;

  protected function beforeValidate() {
    if(!empty($this->dateRange)) {
      list($this->startDate, $this->endDate) = explode(' - ', $this->dateRange);
    }
    $this->startDate = date('Y-m-d', strtotime($this->startDate));
    $this->endDate  = date('Y-m-d', strtotime($this->endDate));

    $this->startDate = '2017-03-29';
    $this->endDate = '2017-03-31';

//    foreach ($this->rooms as $key => $room) {
//      $this->searchRooms[$room] = $this->noOfRooms[$key];
//    }
    $this->noOfRooms = array_values($this->noOfRooms);
    $this->rooms = array_values($this->rooms);

    return parent::beforeValidate();
  }

  /**
   * Declares the validation rules.
   */
  public function rules() {
    return array(
      // name, email, subject and body are required
      array('dateRange, noOfRooms, rooms', 'required'),
      array('startDate, endDate', 'date','format' => array('yyyy-MM-dd')),
      array('noOfRooms', 'checkIntegerValid'),
      array('book_button', 'safe'),
    );
  }

  public function checkIntegerValid() {
    if (!$this->hasErrors()) {
      $noOfRooms = $this->noOfRooms;
      foreach ($noOfRooms as $noOfRoom) {
        if (!filter_var($noOfRoom,FILTER_VALIDATE_INT)) {
          $this->addError('noOfRooms', "Please valid integer for Room no.");
          break;
        }
      }
      return true;
    }
  }


  public function findRooms() {

    $sql = "SELECT 
              r.`id`,
              r.`room_name`,
              r.`room_count`,
              SUM(bd.`number_count`)  AS 'booked',              
              (r.`room_count` - SUM(bd.`number_count`)) AS 'available_rooms'  ,
              r.`room_count`,
              r.`room_price`
            FROM
              `booking` b 
              INNER JOIN `booking_details` bd 
                ON b.id = bd.`booking_id` 
                AND b.`arrival_date` = :startDate 
                AND b.`departure_date` = :endDate 
            RIGHT JOIN (SELECT * FROM rooms r WHERE FIND_IN_SET (r.`id`, :rooms)) r ON bd.`room_id` = r.`id` AND FIND_IN_SET (bd.`room_id`, :rooms)
            GROUP BY
                bd.`room_id`
            order by 
                r.id";

    $command = Yii::app()->db->createCommand($sql);
    $command->bindParam(":startDate",$this->startDate,PDO::PARAM_STR);
    $command->bindParam(":endDate",$this->endDate,PDO::PARAM_STR);
    $rooms_str = implode(',', $this->rooms);
    $command->bindParam(":rooms",$rooms_str,PDO::PARAM_STR);

    $results = $command->queryAll();

    $booked_rooms = array();
    $total_booking_price  = 0;
    $is_valid = true;
    $is_bookable = true;
    if (!empty($results)) {
      foreach ($results as $room_result) {
        $rooms_key = array_search($room_result['id'],$this->rooms);
        $rooms_search_count = 0;
        if (isset($this->noOfRooms[$rooms_key])) {
          $rooms_search_count = $this->noOfRooms[$rooms_key];
        }

        if ($rooms_search_count > $room_result['room_count']) {
          $is_valid = false;
          $this->addError('noOfRooms', "Only {$room_result['room_count']} {$room_result['room_name']} is available.");
          break;
        }

        $room_result['searched_rooms'] = $rooms_search_count;
        if (is_null($room_result['available_rooms']) || $room_result['available_rooms'] >= $rooms_search_count ) {
          $room_result['price'] = $room_result['room_price'] * $rooms_search_count;
        } else {
          $is_bookable = false;
          $room_result['price'] = 0;
        }
        $total_booking_price += $room_result['price'];
        $booked_rooms[$room_result['id']] = $room_result;
      }
    }
    $this->is_bookable = $is_bookable;
    $this->total_booking_price = $total_booking_price;
    $this->bookedRooms = $booked_rooms;

    if(!$this->is_bookable) {
      $this->book_button = null;
    }
//    var_dump($this->noOfRooms);
//    var_dump($this->rooms);
//    exit;
    if(!$is_valid) {
      return false;
    } else {
      return true;
    }
//    sort($this->rooms);

//    var_dump($booked_rooms);
//    var_dump($this->noOfRooms);
//    var_dump($this->rooms);
//    exit;

//    foreach ($this->rooms as $key => $room) {
//      if (isset($booked_rooms[$room[$key]])) {
//        $booked_room = $booked_rooms[$room[$key]];
//        var_dump($this->noOfRooms[$booked_room['room_id']]);
//        if ($booked_room['available_rooms'] >= $this->noOfRooms[$booked_room['room_id']]) {
//
//        } else {
//
//        }
//      } else {
//
//      }
//    }
//    var_dump($booked_rooms);
//    var_dump($this->noOfRooms);
//    var_dump($this->rooms);
//    exit;
  }
}