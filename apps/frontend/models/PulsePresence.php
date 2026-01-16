<?
use Phalcon\ModelBase;

class PulsePresence extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pupr_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pupr_user_id;

	/**
	 * @Column(column='conversation_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pupr_conversation_id;

	/**
	 * @Column(column='status', type='', mtype='enum', nullable=false, default='active', 'length': 'active,away,offline')
	 */
	public $pupr_status;

	/**
	 * @Column(column='last_seen_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pupr_last_seen_at;

	/**
	 * @Column(column='typing_until', type='datetime', mtype='datetime', nullable=true)
	 */
	public $pupr_typing_until;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('pupr_conversation_id', 'PulseConversations', 'puco_id', array('alias' => 'pulse_conversations_conversation_id'));
		$this->belongsTo('pupr_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('pulse_presence');
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
            'id' => 'pupr_id',
			'user_id' => 'pupr_user_id',
			'conversation_id' => 'pupr_conversation_id',
			'status' => 'pupr_status',
			'last_seen_at' => 'pupr_last_seen_at',
			'typing_until' => 'pupr_typing_until'
        );
    }

}
