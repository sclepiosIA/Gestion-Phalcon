<?php
use Phalcon\ModelBase;

class PulsePolls extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pupo_id;

	/**
	 * @Column(column='conversation_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pupo_conversation_id;

	/**
	 * @Column(column='message_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pupo_message_id;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pupo_created_by;

	/**
	 * @Column(column='question', type='text', mtype='longtext', nullable=false)
	 */
	public $pupo_question;

	/**
	 * @Column(column='is_multiple_choice', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $pupo_is_multiple_choice;

	/**
	 * @Column(column='is_anonymous', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $pupo_is_anonymous;

	/**
	 * @Column(column='ends_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $pupo_ends_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pupo_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('pupo_id', 'PulsePollOptions', 'pupoop_poll_id', array('alias' => 'pulse_poll_options_poll_id'));
		$this->hasMany('pupo_id', 'PulsePollVotes', 'pupovo_poll_id', array('alias' => 'pulse_poll_votes_poll_id'));

		$this->belongsTo('pupo_conversation_id', 'PulseConversations', 'puco_id', array('alias' => 'pulse_conversations_conversation_id'));
		$this->belongsTo('pupo_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('pupo_message_id', 'PulseMessages', 'pume_id', array('alias' => 'pulse_messages_message_id'));

        $this->setSource('pulse_polls');
        parent::initialize();
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap():array
    {
        return array(
            'id' => 'pupo_id',
			'conversation_id' => 'pupo_conversation_id',
			'message_id' => 'pupo_message_id',
			'created_by' => 'pupo_created_by',
			'question' => 'pupo_question',
			'is_multiple_choice' => 'pupo_is_multiple_choice',
			'is_anonymous' => 'pupo_is_anonymous',
			'ends_at' => 'pupo_ends_at',
			'created_at' => 'pupo_created_at'
        );
    }

}
