<?php
use Phalcon\ModelBase;

class AuthorizedIps extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $auip_id;

	/**
	 * @Column(column='ip_address', type='string', mtype='varchar', nullable=false, key='UNI', 'length': 45)
	 */
	public $auip_ip_address;

	/**
	 * @Column(column='description', type='text', mtype='longtext', nullable=true)
	 */
	public $auip_description;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $auip_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $auip_updated_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $auip_created_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('auip_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));

        $this->setSource('authorized_ips');
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
            'id' => 'auip_id',
			'ip_address' => 'auip_ip_address',
			'description' => 'auip_description',
			'created_at' => 'auip_created_at',
			'updated_at' => 'auip_updated_at',
			'created_by' => 'auip_created_by'
        );
    }

}
