<?php
App::uses('AppModel', 'Model');
/**
 * Invite Model
 *
 * @property Game $Game
 * @property Player $Player
 */
class Invite extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'game_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'player_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Game' => array(
			'className' => 'Game',
			'foreignKey' => 'game_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Player' => array(
			'className' => 'Player',
			'foreignKey' => 'player_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


/**
 * invites method
 *
 * @param string $id
 * @return array
 */
    public function invites($id) {
        $options = array('order' => array('Player.conv' => 'asc', 'Player.rating' => 'desc'), 'conditions' => array('game_id' => $id));
        $invites = $this->find('all', $options);
        $players = $this->Player->find('list');

        foreach($invites as $invite) {
            $invite_list[$invite['Invite']['player_id']] = null;
        }
        foreach($players as $key => $player) {
            if(!array_key_exists($key, $invite_list)) {
                $notinvited[$key] = $player;
            }
        }

        return array('invites' => $invites,
                     'notinvited' => $notinvited);

    }
}
