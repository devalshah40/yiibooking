<?php
/**
 * Role List
 */
return array(
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'User',
        'children' => array(
            'user',
        ),
        'bizRule' => null,
        'data' => null
    ),
);