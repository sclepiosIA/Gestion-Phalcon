<?
use Phalcon\ModelBase;

class NotificationsRules extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $noru_id;

	/**
	 * @Column(column='name', type='text', mtype='text', nullable=false)
	 */
	public $noru_name;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $noru_description;

	/**
	 * @Column(column='event_type', type='text', mtype='text', nullable=false)
	 */
	public $noru_event_type;

	/**
	 * @Column(column='conditions', type='', mtype='json', nullable=true)
	 */
	public $noru_conditions;

	/**
	 * @Column(column='recipients', type='', mtype='json', nullable=false)
	 */
	public $noru_recipients;

	/**
	 * @Column(column='email_template', type='text', mtype='text', nullable=true)
	 */
	public $noru_email_template;

	/**
	 * @Column(column='is_active', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $noru_is_active;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $noru_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $noru_updated_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $noru_created_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('noru_id', 'NotificationsHistory', 'nohi_rule_id', array('alias' => 'notifications_history_rule_id'));

		$this->belongsTo('noru_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));

        $this->setSource('notifications_rules');
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
            'id' => 'noru_id',
			'name' => 'noru_name',
			'description' => 'noru_description',
			'event_type' => 'noru_event_type',
			'conditions' => 'noru_conditions',
			'recipients' => 'noru_recipients',
			'email_template' => 'noru_email_template',
			'is_active' => 'noru_is_active',
			'created_at' => 'noru_created_at',
			'updated_at' => 'noru_updated_at',
			'created_by' => 'noru_created_by'
        );
    }

}
