<?php

class AvailableroomForm extends CFormModel {
  public $startDate;
  public $endDate;

  /**
   * Declares the validation rules.
   */
  public function rules() {
    return array(
    );
  }

  public function findRoomBookings() {

//    var_dump($this->startDate);

    $this->startDate = date('Y-m-d', strtotime($this->startDate));
    $this->endDate = date('Y-m-d', strtotime($this->endDate));
//    var_dump($this->startDate);
//    exit;

    $models = Rooms::model()->findAll(array(
      'condition' => 'room_status=:status',
      'params' => array(':status' => 1)
    ));

    $rooms = array();
    foreach ($models as $model) {
      $room_count = $model->room_count;
      $room_name = $model->room_name;
      $rooms[$model->id] = array(
        'room_count' => $room_count,
        'room_name' => $room_name
      );
    }

    $begin = new DateTime( $this->startDate );
    $end = new DateTime( $this->endDate );

//    var_dump($this->startDate);
//    var_dump($begin);exit;

    $availableRooms = array();
    for($i = $begin; $i <= $end; $i->modify('+1 day')){
      $booked_date = $i->format("Y-m-d");
      $availableRooms[$booked_date] = $rooms;
    }

//    var_dump($availableRooms);exit;

//    $interval = DateInterval::createFromDateString('1 day');
//    $period = new DatePeriod($begin, $interval, $end);
//
//    $availableRooms = array();
//    foreach ( $period as $dt ) {
//      $booked_date = $dt->format("Y-m-d");
//      $availableRooms[$booked_date] = $rooms;
//    }
//
//    var_dump($availableRooms);exit;

    $sql = "SELECT 
              b.`id`,	
              b.`arrival_date`,
              b.`departure_date`,
              bd.`room_id`,
              bd.`number_count`
            FROM
              `booking` b 
              INNER JOIN `booking_details` bd 
                ON b.id = bd.`booking_id` 
                AND ( b.`arrival_date`  >= :startDate  AND  b.`departure_date` <= :endDate )
			";

    $command = Yii::app()->db->createCommand($sql);

    $command->bindParam(":startDate",$this->startDate,PDO::PARAM_STR);
    $command->bindParam(":endDate",$this->endDate,PDO::PARAM_STR);


    $results = $command->queryAll();

    $bookedResults = array();
    foreach ($results as $bookedRow) {
//      $arrival_date = $bookedRow['arrival_date'];
//      $departure_date = $bookedRow['departure_date'];

      $begin = new DateTime( $bookedRow['arrival_date'] );
      $end = new DateTime( $bookedRow['departure_date'] );

//    var_dump($this->startDate);
//    var_dump($begin);exit;

      for($i = $begin; $i < $end; $i->modify('+1 day')){
        $booked_date = $i->format("Y-m-d");

        $roomsBooked = &$availableRooms[$booked_date][$bookedRow['room_id']];
//        var_dump($bookedRow);
//        var_dump($roomsBooked);
        $roomsBooked['room_count'] -= $bookedRow['number_count'];
//        var_dump($bookedRow);
//        var_dump($roomsBooked);exit;
      }
    }
//    var_dump($availableRooms);exit;
    return $availableRooms;
  }
}