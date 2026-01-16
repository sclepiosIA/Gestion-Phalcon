<?
use Phalcon\ModelBase;

class CustomerActivities extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $cuac_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $cuac_etablissement_id;

	/**
	 * @Column(column='activity_type', type='string', mtype='varchar', nullable=false, key='MUL', 'length': 30)
	 */
	public $cuac_activity_type;

	/**
	 * @Column(column='title', type='text', mtype='text', nullable=false)
	 */
	public $cuac_title;

	/**
	 * @Column(column='description', type='text', mtype='longtext', nullable=true)
	 */
	public $cuac_description;

	/**
	 * @Column(column='activity_date', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $cuac_activity_date;

	/**
	 * @Column(column='scheduled_date', type='datetime', mtype='datetime', nullable=true, key='MUL')
	 */
	public $cuac_scheduled_date;

	/**
	 * @Column(column='completed_date', type='datetime', mtype='datetime', nullable=true)
	 */
	public $cuac_completed_date;

	/**
	 * @Column(column='metadata', type='', mtype='json', nullable=true)
	 */
	public $cuac_metadata;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $cuac_created_by;

	/**
	 * @Column(column='assigned_to', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $cuac_assigned_to;

	/**
	 * @Column(column='status', type='string', mtype='varchar', nullable=false, default='completed', 'length': 20)
	 */
	public $cuac_status;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $cuac_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $cuac_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('cuac_assigned_to', 'Profiles', 'pr_id', array('alias' => 'profiles_assigned_to'));
		$this->belongsTo('cuac_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('cuac_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));

        $this->setSource('customer_activities');
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
            'id' => 'cuac_id',
			'etablissement_id' => 'cuac_etablissement_id',
			'activity_type' => 'cuac_activity_type',
			'title' => 'cuac_title',
			'description' => 'cuac_description',
			'activity_date' => 'cuac_activity_date',
			'scheduled_date' => 'cuac_scheduled_date',
			'completed_date' => 'cuac_completed_date',
			'metadata' => 'cuac_metadata',
			'created_by' => 'cuac_created_by',
			'assigned_to' => 'cuac_assigned_to',
			'status' => 'cuac_status',
			'created_at' => 'cuac_created_at',
			'updated_at' => 'cuac_updated_at'
        );
    }

}
