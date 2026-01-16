<?
use Phalcon\ModelBase;

class EventAttendees extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $evat_id;

	/**
	 * @Column(column='event_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $evat_event_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $evat_user_id;

	/**
	 * @Column(column='email', type='text', mtype='text', nullable=false)
	 */
	public $evat_email;

	/**
	 * @Column(column='display_name', type='text', mtype='text', nullable=true)
	 */
	public $evat_display_name;

	/**
	 * @Column(column='role', type='', mtype='enum', nullable=false, default='required', 'length': 'organizer,required,optional,admin,commercial,chef_projet,csm,manager,rh,user')
	 */
	public $evat_role;

	/**
	 * @Column(column='status', type='', mtype='enum', nullable=false, default='pending', 'length': 'pending,accepted,declined,tentative')
	 */
	public $evat_status;

	/**
	 * @Column(column='responded_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $evat_responded_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $evat_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('evat_event_id', 'CalendarEvents', 'caev_id', array('alias' => 'calendar_events_event_id'));
		$this->belongsTo('evat_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('event_attendees');
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
            'id' => 'evat_id',
			'event_id' => 'evat_event_id',
			'user_id' => 'evat_user_id',
			'email' => 'evat_email',
			'display_name' => 'evat_display_name',
			'role' => 'evat_role',
			'status' => 'evat_status',
			'responded_at' => 'evat_responded_at',
			'created_at' => 'evat_created_at'
        );
    }

}
