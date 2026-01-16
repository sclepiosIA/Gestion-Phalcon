<?
use Phalcon\ModelBase;

class PulseAuditLog extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $puaulo_id;

	/**
	 * @Column(column='action', type='string', mtype='varchar', nullable=false, key='MUL', 'length': 50)
	 */
	public $puaulo_action;

	/**
	 * @Column(column='actor_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $puaulo_actor_id;

	/**
	 * @Column(column='conversation_id', type='string', mtype='varchar', nullable=true, key='MUL', 'length': 36)
	 */
	public $puaulo_conversation_id;

	/**
	 * @Column(column='message_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $puaulo_message_id;

	/**
	 * @Column(column='task_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $puaulo_task_id;

	/**
	 * @Column(column='details', type='', mtype='json', nullable=true)
	 */
	public $puaulo_details;

	/**
	 * @Column(column='status', type='', mtype='enum', nullable=true, default='success', 'length': 'success,failure,pending')
	 */
	public $puaulo_status;

	/**
	 * @Column(column='error_message', type='text', mtype='text', nullable=true)
	 */
	public $puaulo_error_message;

	/**
	 * @Column(column='ip_address', type='string', mtype='varchar', nullable=true, 'length': 45)
	 */
	public $puaulo_ip_address;

	/**
	 * @Column(column='user_agent', type='text', mtype='text', nullable=true)
	 */
	public $puaulo_user_agent;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $puaulo_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('puaulo_actor_id', 'Profiles', 'pr_id', array('alias' => 'profiles_actor_id'));

        $this->setSource('pulse_audit_log');
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
            'id' => 'puaulo_id',
			'action' => 'puaulo_action',
			'actor_id' => 'puaulo_actor_id',
			'conversation_id' => 'puaulo_conversation_id',
			'message_id' => 'puaulo_message_id',
			'task_id' => 'puaulo_task_id',
			'details' => 'puaulo_details',
			'status' => 'puaulo_status',
			'error_message' => 'puaulo_error_message',
			'ip_address' => 'puaulo_ip_address',
			'user_agent' => 'puaulo_user_agent',
			'created_at' => 'puaulo_created_at'
        );
    }

}
