<?
use Phalcon\ModelBase;

class PulseReactions extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pure_id;

	/**
	 * @Column(column='message_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pure_message_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pure_user_id;

	/**
	 * @Column(column='emoji', type='string', mtype='varchar', nullable=false, 'length': 10)
	 */
	public $pure_emoji;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pure_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('pure_message_id', 'PulseMessages', 'pume_id', array('alias' => 'pulse_messages_message_id'));
		$this->belongsTo('pure_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('pulse_reactions');
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
            'id' => 'pure_id',
			'message_id' => 'pure_message_id',
			'user_id' => 'pure_user_id',
			'emoji' => 'pure_emoji',
			'created_at' => 'pure_created_at'
        );
    }

}
