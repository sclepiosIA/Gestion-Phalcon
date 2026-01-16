<?
use Phalcon\ModelBase;

class CustomerHealthMetrics extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $cuheme_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=false, key='UNI', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $cuheme_etablissement_id;

	/**
	 * @Column(column='health_score', type='integer', mtype='int', nullable=true, key='MUL')
	 */
	public $cuheme_health_score;

	/**
	 * @Column(column='health_status', type='string', mtype='varchar', nullable=true, key='MUL', 'length': 20)
	 */
	public $cuheme_health_status;

	/**
	 * @Column(column='adoption_rate', type='decimal', mtype='decimal', nullable=true, 'length': 10)
	 */
	public $cuheme_adoption_rate;

	/**
	 * @Column(column='active_users', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $cuheme_active_users;

	/**
	 * @Column(column='total_licenses', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $cuheme_total_licenses;

	/**
	 * @Column(column='last_login_date', type='datetime', mtype='datetime', nullable=true)
	 */
	public $cuheme_last_login_date;

	/**
	 * @Column(column='logins_last_30_days', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $cuheme_logins_last_30_days;

	/**
	 * @Column(column='features_used_count', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $cuheme_features_used_count;

	/**
	 * @Column(column='avg_session_duration_minutes', type='decimal', mtype='decimal', nullable=true, 'length': 10)
	 */
	public $cuheme_avg_session_duration_minutes;

	/**
	 * @Column(column='support_tickets_open', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $cuheme_support_tickets_open;

	/**
	 * @Column(column='support_tickets_closed_30d', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $cuheme_support_tickets_closed_30d;

	/**
	 * @Column(column='avg_resolution_time_hours', type='decimal', mtype='decimal', nullable=true, 'length': 10)
	 */
	public $cuheme_avg_resolution_time_hours;

	/**
	 * @Column(column='last_ticket_date', type='datetime', mtype='datetime', nullable=true)
	 */
	public $cuheme_last_ticket_date;

	/**
	 * @Column(column='nps_score', type='decimal', mtype='decimal', nullable=true, 'length': 10)
	 */
	public $cuheme_nps_score;

	/**
	 * @Column(column='nps_survey_date', type='datetime', mtype='datetime', nullable=true)
	 */
	public $cuheme_nps_survey_date;

	/**
	 * @Column(column='satisfaction_score', type='integer', mtype='int', nullable=true)
	 */
	public $cuheme_satisfaction_score;

	/**
	 * @Column(column='payment_status', type='string', mtype='varchar', nullable=false, default='on_time', 'length': 20)
	 */
	public $cuheme_payment_status;

	/**
	 * @Column(column='contract_value', type='decimal', mtype='decimal', nullable=true, 'length': 12)
	 */
	public $cuheme_contract_value;

	/**
	 * @Column(column='contract_start_date', type='date', mtype='date', nullable=true)
	 */
	public $cuheme_contract_start_date;

	/**
	 * @Column(column='contract_end_date', type='date', mtype='date', nullable=true, key='MUL')
	 */
	public $cuheme_contract_end_date;

	/**
	 * @Column(column='calculated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $cuheme_calculated_at;

	/**
	 * @Column(column='notes', type='text', mtype='longtext', nullable=true)
	 */
	public $cuheme_notes;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $cuheme_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $cuheme_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('cuheme_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));

        $this->setSource('customer_health_metrics');
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
            'id' => 'cuheme_id',
			'etablissement_id' => 'cuheme_etablissement_id',
			'health_score' => 'cuheme_health_score',
			'health_status' => 'cuheme_health_status',
			'adoption_rate' => 'cuheme_adoption_rate',
			'active_users' => 'cuheme_active_users',
			'total_licenses' => 'cuheme_total_licenses',
			'last_login_date' => 'cuheme_last_login_date',
			'logins_last_30_days' => 'cuheme_logins_last_30_days',
			'features_used_count' => 'cuheme_features_used_count',
			'avg_session_duration_minutes' => 'cuheme_avg_session_duration_minutes',
			'support_tickets_open' => 'cuheme_support_tickets_open',
			'support_tickets_closed_30d' => 'cuheme_support_tickets_closed_30d',
			'avg_resolution_time_hours' => 'cuheme_avg_resolution_time_hours',
			'last_ticket_date' => 'cuheme_last_ticket_date',
			'nps_score' => 'cuheme_nps_score',
			'nps_survey_date' => 'cuheme_nps_survey_date',
			'satisfaction_score' => 'cuheme_satisfaction_score',
			'payment_status' => 'cuheme_payment_status',
			'contract_value' => 'cuheme_contract_value',
			'contract_start_date' => 'cuheme_contract_start_date',
			'contract_end_date' => 'cuheme_contract_end_date',
			'calculated_at' => 'cuheme_calculated_at',
			'notes' => 'cuheme_notes',
			'created_at' => 'cuheme_created_at',
			'updated_at' => 'cuheme_updated_at'
        );
    }

}
