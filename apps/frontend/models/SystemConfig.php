<?php
use Phalcon\ModelBase;

class SystemConfig extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $syco_id;

	/**
	 * @Column(column='key', type='text', mtype='text', nullable=false, key='UNI')
	 */
	public $syco_key;

	/**
	 * @Column(column='value', type='text', mtype='text', nullable=false)
	 */
	public $syco_value;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $syco_description;

	/**
	 * @Column(column='category', type='text', mtype='text', nullable=false)
	 */
	public $syco_category;

	/**
	 * @Column(column='data_type', type='text', mtype='text', nullable=false)
	 */
	public $syco_data_type;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $syco_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $syco_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {

        $this->setSource('system_config');
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
            'id' => 'syco_id',
			'key' => 'syco_key',
			'value' => 'syco_value',
			'description' => 'syco_description',
			'category' => 'syco_category',
			'data_type' => 'syco_data_type',
			'created_at' => 'syco_created_at',
			'updated_at' => 'syco_updated_at'
        );
    }

}
