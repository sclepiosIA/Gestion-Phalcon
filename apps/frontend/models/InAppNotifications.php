<?
use Phalcon\ModelBase;

class InAppNotifications extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $inapno_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $inapno_user_id;

	/**
	 * @Column(column='title', type='text', mtype='text', nullable=false)
	 */
	public $inapno_title;

	/**
	 * @Column(column='message', type='text', mtype='longtext', nullable=false)
	 */
	public $inapno_message;

	/**
	 * @Column(column='type', type='string', mtype='varchar', nullable=false, 'length': 50)
	 */
	public $inapno_type;

	/**
	 * @Column(column='related_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $inapno_related_id;

	/**
	 * @Column(column='related_type', type='string', mtype='varchar', nullable=true, 'length': 50)
	 */
	public $inapno_related_type;

	/**
	 * @Column(column='is_read', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $inapno_is_read;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $inapno_created_at;

	/**
	 * @Column(column='read_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $inapno_read_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('inapno_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('in_app_notifications');
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
            'id' => 'inapno_id',
			'user_id' => 'inapno_user_id',
			'title' => 'inapno_title',
			'message' => 'inapno_message',
			'type' => 'inapno_type',
			'related_id' => 'inapno_related_id',
			'related_type' => 'inapno_related_type',
			'is_read' => 'inapno_is_read',
			'created_at' => 'inapno_created_at',
			'read_at' => 'inapno_read_at'
        );
    }

}
