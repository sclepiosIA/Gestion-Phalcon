<?php
use Phalcon\ModelBase;

class CalendarShares extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $cash_id;

	/**
	 * @Column(column='calendar_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $cash_calendar_id;

	/**
	 * @Column(column='shared_with_user_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $cash_shared_with_user_id;

	/**
	 * @Column(column='shared_with_email', type='text', mtype='text', nullable=true)
	 */
	public $cash_shared_with_email;

	/**
	 * @Column(column='permission', type='', mtype='enum', nullable=false, default='read', 'length': 'read,write,admin')
	 */
	public $cash_permission;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $cash_created_by;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $cash_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('cash_calendar_id', 'Calendars', 'ca_id', array('alias' => 'calendars_calendar_id'));
		$this->belongsTo('cash_created_by', 'Users', 'us_id', array('alias' => 'users_created_by'));
		$this->belongsTo('cash_shared_with_user_id', 'Users', 'us_id', array('alias' => 'users_shared_with_user_id'));

        $this->setSource('calendar_shares');
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
            'id' => 'cash_id',
			'calendar_id' => 'cash_calendar_id',
			'shared_with_user_id' => 'cash_shared_with_user_id',
			'shared_with_email' => 'cash_shared_with_email',
			'permission' => 'cash_permission',
			'created_by' => 'cash_created_by',
			'created_at' => 'cash_created_at'
        );
    }

}
