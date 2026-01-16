<?php
use Phalcon\ModelBase;

class CalendarEvents extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $caev_id;

	/**
	 * @Column(column='calendar_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $caev_calendar_id;

	/**
	 * @Column(column='title', type='text', mtype='text', nullable=false)
	 */
	public $caev_title;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $caev_description;

	/**
	 * @Column(column='location', type='text', mtype='text', nullable=true)
	 */
	public $caev_location;

	/**
	 * @Column(column='video_conference_url', type='text', mtype='text', nullable=true)
	 */
	public $caev_video_conference_url;

	/**
	 * @Column(column='start_time', type='datetime', mtype='datetime', nullable=false, key='MUL')
	 */
	public $caev_start_time;

	/**
	 * @Column(column='end_time', type='datetime', mtype='datetime', nullable=false)
	 */
	public $caev_end_time;

	/**
	 * @Column(column='all_day', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $caev_all_day;

	/**
	 * @Column(column='status', type='', mtype='enum', nullable=false, default='confirmed', 'length': 'confirmed,tentative,cancelled')
	 */
	public $caev_status;

	/**
	 * @Column(column='visibility', type='', mtype='enum', nullable=false, default='default', 'length': 'public,private,default')
	 */
	public $caev_visibility;

	/**
	 * @Column(column='recurrence_rule', type='text', mtype='text', nullable=true)
	 */
	public $caev_recurrence_rule;

	/**
	 * @Column(column='recurrence_parent_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $caev_recurrence_parent_id;

	/**
	 * @Column(column='recurrence_exception_dates', type='', mtype='json', nullable=true)
	 */
	public $caev_recurrence_exception_dates;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $caev_etablissement_id;

	/**
	 * @Column(column='tache_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $caev_tache_id;

	/**
	 * @Column(column='color', type='text', mtype='text', nullable=true)
	 */
	public $caev_color;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $caev_created_by;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $caev_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $caev_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('caev_id', 'CalendarEvents', 'caev_recurrence_parent_id', array('alias' => 'calendar_events_recurrence_parent_id'));
		$this->hasMany('caev_id', 'EventAttendees', 'evat_event_id', array('alias' => 'event_attendees_event_id'));
		$this->hasMany('caev_id', 'EventReminders', 'evre_event_id', array('alias' => 'event_reminders_event_id'));

		$this->belongsTo('caev_calendar_id', 'Calendars', 'ca_id', array('alias' => 'calendars_calendar_id'));
		$this->belongsTo('caev_created_by', 'Users', 'us_id', array('alias' => 'users_created_by'));
		$this->belongsTo('caev_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('caev_recurrence_parent_id', 'CalendarEvents', 'caev_id', array('alias' => 'calendar_events_recurrence_parent_id'));
		$this->belongsTo('caev_tache_id', 'Taches', 'ta_id', array('alias' => 'taches_tache_id'));

        $this->setSource('calendar_events');
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
            'id' => 'caev_id',
			'calendar_id' => 'caev_calendar_id',
			'title' => 'caev_title',
			'description' => 'caev_description',
			'location' => 'caev_location',
			'video_conference_url' => 'caev_video_conference_url',
			'start_time' => 'caev_start_time',
			'end_time' => 'caev_end_time',
			'all_day' => 'caev_all_day',
			'status' => 'caev_status',
			'visibility' => 'caev_visibility',
			'recurrence_rule' => 'caev_recurrence_rule',
			'recurrence_parent_id' => 'caev_recurrence_parent_id',
			'recurrence_exception_dates' => 'caev_recurrence_exception_dates',
			'etablissement_id' => 'caev_etablissement_id',
			'tache_id' => 'caev_tache_id',
			'color' => 'caev_color',
			'created_by' => 'caev_created_by',
			'created_at' => 'caev_created_at',
			'updated_at' => 'caev_updated_at'
        );
    }

}
