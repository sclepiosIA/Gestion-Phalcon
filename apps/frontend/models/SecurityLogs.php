<?
use Phalcon\ModelBase;

class SecurityLogs extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $selo_id;

	/**
	 * @Column(column='log_type', type='string', mtype='varchar', nullable=false, key='MUL', 'length': 64)
	 */
	public $selo_log_type;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $selo_user_id;

	/**
	 * @Column(column='user_email', type='text', mtype='text', nullable=true)
	 */
	public $selo_user_email;

	/**
	 * @Column(column='ip_address', type='string', mtype='varchar', nullable=true, 'length': 45)
	 */
	public $selo_ip_address;

	/**
	 * @Column(column='user_agent', type='text', mtype='text', nullable=true)
	 */
	public $selo_user_agent;

	/**
	 * @Column(column='location', type='text', mtype='text', nullable=true)
	 */
	public $selo_location;

	/**
	 * @Column(column='risk_level', type='string', mtype='varchar', nullable=false, default='low', 'length': 16)
	 */
	public $selo_risk_level;

	/**
	 * @Column(column='metadata', type='', mtype='json', nullable=true)
	 */
	public $selo_metadata;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $selo_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('selo_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('security_logs');
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
            'id' => 'selo_id',
			'log_type' => 'selo_log_type',
			'user_id' => 'selo_user_id',
			'user_email' => 'selo_user_email',
			'ip_address' => 'selo_ip_address',
			'user_agent' => 'selo_user_agent',
			'location' => 'selo_location',
			'risk_level' => 'selo_risk_level',
			'metadata' => 'selo_metadata',
			'created_at' => 'selo_created_at'
        );
    }

}
