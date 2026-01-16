<?php
use Phalcon\ModelBase;

class SecurityConfig extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $seco_id;

	/**
	 * @Column(column='password_min_length', type='integer', mtype='int', nullable=false, default='8')
	 */
	public $seco_password_min_length;

	/**
	 * @Column(column='password_require_uppercase', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_password_require_uppercase;

	/**
	 * @Column(column='password_require_lowercase', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_password_require_lowercase;

	/**
	 * @Column(column='password_require_numbers', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_password_require_numbers;

	/**
	 * @Column(column='password_require_symbols', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $seco_password_require_symbols;

	/**
	 * @Column(column='password_expiration', type='integer', mtype='int', nullable=false, default='90')
	 */
	public $seco_password_expiration;

	/**
	 * @Column(column='two_factor_required', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $seco_two_factor_required;

	/**
	 * @Column(column='session_timeout', type='integer', mtype='int', nullable=false, default='3600')
	 */
	public $seco_session_timeout;

	/**
	 * @Column(column='max_login_attempts', type='integer', mtype='int', nullable=false, default='5')
	 */
	public $seco_max_login_attempts;

	/**
	 * @Column(column='lockout_duration', type='integer', mtype='int', nullable=false, default='15')
	 */
	public $seco_lockout_duration;

	/**
	 * @Column(column='ip_whitelist_enabled', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $seco_ip_whitelist_enabled;

	/**
	 * @Column(column='brute_force_protection', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_brute_force_protection;

	/**
	 * @Column(column='security_headers', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_security_headers;

	/**
	 * @Column(column='audit_logging', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_audit_logging;

	/**
	 * @Column(column='login_alerts', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_login_alerts;

	/**
	 * @Column(column='suspicious_activity_alerts', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_suspicious_activity_alerts;

	/**
	 * @Column(column='password_change_alerts', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $seco_password_change_alerts;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $seco_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $seco_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {

        $this->setSource('security_config');
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
            'id' => 'seco_id',
			'password_min_length' => 'seco_password_min_length',
			'password_require_uppercase' => 'seco_password_require_uppercase',
			'password_require_lowercase' => 'seco_password_require_lowercase',
			'password_require_numbers' => 'seco_password_require_numbers',
			'password_require_symbols' => 'seco_password_require_symbols',
			'password_expiration' => 'seco_password_expiration',
			'two_factor_required' => 'seco_two_factor_required',
			'session_timeout' => 'seco_session_timeout',
			'max_login_attempts' => 'seco_max_login_attempts',
			'lockout_duration' => 'seco_lockout_duration',
			'ip_whitelist_enabled' => 'seco_ip_whitelist_enabled',
			'brute_force_protection' => 'seco_brute_force_protection',
			'security_headers' => 'seco_security_headers',
			'audit_logging' => 'seco_audit_logging',
			'login_alerts' => 'seco_login_alerts',
			'suspicious_activity_alerts' => 'seco_suspicious_activity_alerts',
			'password_change_alerts' => 'seco_password_change_alerts',
			'created_at' => 'seco_created_at',
			'updated_at' => 'seco_updated_at'
        );
    }

}
