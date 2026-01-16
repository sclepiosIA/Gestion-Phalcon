<?
use Phalcon\ModelBase;

class Calendars extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $ca_id;

	/**
	 * @Column(column='owner_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $ca_owner_id;

	/**
	 * @Column(column='name', type='text', mtype='text', nullable=false)
	 */
	public $ca_name;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $ca_description;

	/**
	 * @Column(column='color', type='text', mtype='text', nullable=false)
	 */
	public $ca_color;

	/**
	 * @Column(column='type', type='', mtype='enum', nullable=false, default='personal', 'length': 'personal,team,establishment,absences,shared')
	 */
	public $ca_type;

	/**
	 * @Column(column='is_default', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $ca_is_default;

	/**
	 * @Column(column='is_visible', type='integer', mtype='tinyint', nullable=true, default='1', 'length': 1)
	 */
	public $ca_is_visible;

	/**
	 * @Column(column='timezone', type='text', mtype='text', nullable=true)
	 */
	public $ca_timezone;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $ca_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $ca_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('ca_id', 'CalendarEvents', 'caev_calendar_id', array('alias' => 'calendar_events_calendar_id'));
		$this->hasMany('ca_id', 'CalendarShares', 'cash_calendar_id', array('alias' => 'calendar_shares_calendar_id'));

		$this->belongsTo('ca_owner_id', 'Users', 'us_id', array('alias' => 'users_owner_id'));

        $this->setSource('calendars');
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
            'id' => 'ca_id',
			'owner_id' => 'ca_owner_id',
			'name' => 'ca_name',
			'description' => 'ca_description',
			'color' => 'ca_color',
			'type' => 'ca_type',
			'is_default' => 'ca_is_default',
			'is_visible' => 'ca_is_visible',
			'timezone' => 'ca_timezone',
			'created_at' => 'ca_created_at',
			'updated_at' => 'ca_updated_at'
        );
    }

}
