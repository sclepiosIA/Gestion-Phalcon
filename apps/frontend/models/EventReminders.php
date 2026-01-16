<?
use Phalcon\ModelBase;

class EventReminders extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $evre_id;

	/**
	 * @Column(column='event_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $evre_event_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $evre_user_id;

	/**
	 * @Column(column='minutes_before', type='integer', mtype='int', nullable=false, default='15')
	 */
	public $evre_minutes_before;

	/**
	 * @Column(column='type', type='', mtype='enum', nullable=false, default='notification', 'length': 'notification,email,push')
	 */
	public $evre_type;

	/**
	 * @Column(column='is_sent', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $evre_is_sent;

	/**
	 * @Column(column='sent_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $evre_sent_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $evre_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('evre_event_id', 'CalendarEvents', 'caev_id', array('alias' => 'calendar_events_event_id'));
		$this->belongsTo('evre_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('event_reminders');
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
            'id' => 'evre_id',
			'event_id' => 'evre_event_id',
			'user_id' => 'evre_user_id',
			'minutes_before' => 'evre_minutes_before',
			'type' => 'evre_type',
			'is_sent' => 'evre_is_sent',
			'sent_at' => 'evre_sent_at',
			'created_at' => 'evre_created_at'
        );
    }

}
