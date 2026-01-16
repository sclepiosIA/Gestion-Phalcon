<?
use Phalcon\ModelBase;

class BlockedIps extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $blip_id;

	/**
	 * @Column(column='ip_address', type='string', mtype='varchar', nullable=false, key='UNI', 'length': 45)
	 */
	public $blip_ip_address;

	/**
	 * @Column(column='blocked_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $blip_blocked_by;

	/**
	 * @Column(column='reason', type='text', mtype='text', nullable=true)
	 */
	public $blip_reason;

	/**
	 * @Column(column='blocked_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $blip_blocked_at;

	/**
	 * @Column(column='expires_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $blip_expires_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('blip_blocked_by', 'Profiles', 'pr_id', array('alias' => 'profiles_blocked_by'));

        $this->setSource('blocked_ips');
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
            'id' => 'blip_id',
			'ip_address' => 'blip_ip_address',
			'blocked_by' => 'blip_blocked_by',
			'reason' => 'blip_reason',
			'blocked_at' => 'blip_blocked_at',
			'expires_at' => 'blip_expires_at'
        );
    }

}
