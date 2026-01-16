<?
use Phalcon\ModelBase;

class PulseMessageArchive extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pumear_id;

	/**
	 * @Column(column='original_message_id', type='string', mtype='varchar', nullable=false, key='MUL', 'length': 36)
	 */
	public $pumear_original_message_id;

	/**
	 * @Column(column='conversation_id', type='string', mtype='varchar', nullable=false, key='MUL', 'length': 36)
	 */
	public $pumear_conversation_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $pumear_user_id;

	/**
	 * @Column(column='content_snapshot', type='', mtype='json', nullable=false)
	 */
	public $pumear_content_snapshot;

	/**
	 * @Column(column='deleted_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pumear_deleted_at;

	/**
	 * @Column(column='deleted_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pumear_deleted_by;

	/**
	 * @Column(column='deletion_reason', type='text', mtype='text', nullable=true)
	 */
	public $pumear_deletion_reason;

	/**
	 * @Column(column='restored', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $pumear_restored;

	/**
	 * @Column(column='restored_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $pumear_restored_at;

	/**
	 * @Column(column='restored_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pumear_restored_by;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pumear_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('pumear_deleted_by', 'Profiles', 'pr_id', array('alias' => 'profiles_deleted_by'));
		$this->belongsTo('pumear_restored_by', 'Profiles', 'pr_id', array('alias' => 'profiles_restored_by'));

        $this->setSource('pulse_message_archive');
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
            'id' => 'pumear_id',
			'original_message_id' => 'pumear_original_message_id',
			'conversation_id' => 'pumear_conversation_id',
			'user_id' => 'pumear_user_id',
			'content_snapshot' => 'pumear_content_snapshot',
			'deleted_at' => 'pumear_deleted_at',
			'deleted_by' => 'pumear_deleted_by',
			'deletion_reason' => 'pumear_deletion_reason',
			'restored' => 'pumear_restored',
			'restored_at' => 'pumear_restored_at',
			'restored_by' => 'pumear_restored_by',
			'created_at' => 'pumear_created_at'
        );
    }

}
