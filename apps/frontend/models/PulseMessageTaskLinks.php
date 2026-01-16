<?php
use Phalcon\ModelBase;

class PulseMessageTaskLinks extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pumetali_id;

	/**
	 * @Column(column='message_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pumetali_message_id;

	/**
	 * @Column(column='task_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pumetali_task_id;

	/**
	 * @Column(column='conversation_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pumetali_conversation_id;

	/**
	 * @Column(column='link_type', type='', mtype='enum', nullable=false, default='mentions', 'length': 'mentions,created_from,status_update')
	 */
	public $pumetali_link_type;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pumetali_created_by;

	/**
	 * @Column(column='metadata', type='', mtype='json', nullable=true)
	 */
	public $pumetali_metadata;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pumetali_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('pumetali_conversation_id', 'PulseConversations', 'puco_id', array('alias' => 'pulse_conversations_conversation_id'));
		$this->belongsTo('pumetali_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('pumetali_message_id', 'PulseMessages', 'pume_id', array('alias' => 'pulse_messages_message_id'));
		$this->belongsTo('pumetali_task_id', 'Taches', 'ta_id', array('alias' => 'taches_task_id'));

        $this->setSource('pulse_message_task_links');
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
            'id' => 'pumetali_id',
			'message_id' => 'pumetali_message_id',
			'task_id' => 'pumetali_task_id',
			'conversation_id' => 'pumetali_conversation_id',
			'link_type' => 'pumetali_link_type',
			'created_by' => 'pumetali_created_by',
			'metadata' => 'pumetali_metadata',
			'created_at' => 'pumetali_created_at'
        );
    }

}
