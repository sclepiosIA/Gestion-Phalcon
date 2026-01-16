<?
use Phalcon\ModelBase;

class PulseConversationMembers extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pucome_id;

	/**
	 * @Column(column='conversation_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pucome_conversation_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pucome_user_id;

	/**
	 * @Column(column='role', type='', mtype='enum', nullable=false, default='member', 'length': 'admin,member,guest')
	 */
	public $pucome_role;

	/**
	 * @Column(column='notification_level', type='', mtype='enum', nullable=false, default='all', 'length': 'all,mentions,none')
	 */
	public $pucome_notification_level;

	/**
	 * @Column(column='last_read_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $pucome_last_read_at;

	/**
	 * @Column(column='joined_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pucome_joined_at;

	/**
	 * @Column(column='invited_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pucome_invited_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('pucome_conversation_id', 'PulseConversations', 'puco_id', array('alias' => 'pulse_conversations_conversation_id'));
		$this->belongsTo('pucome_invited_by', 'Profiles', 'pr_id', array('alias' => 'profiles_invited_by'));
		$this->belongsTo('pucome_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('pulse_conversation_members');
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
            'id' => 'pucome_id',
			'conversation_id' => 'pucome_conversation_id',
			'user_id' => 'pucome_user_id',
			'role' => 'pucome_role',
			'notification_level' => 'pucome_notification_level',
			'last_read_at' => 'pucome_last_read_at',
			'joined_at' => 'pucome_joined_at',
			'invited_by' => 'pucome_invited_by'
        );
    }

}
