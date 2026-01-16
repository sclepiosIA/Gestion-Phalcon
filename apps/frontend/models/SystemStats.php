<?
use Phalcon\ModelBase;

class SystemStats extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $syst_id;

	/**
	 * @Column(column='metric_name', type='text', mtype='text', nullable=false, key='MUL')
	 */
	public $syst_metric_name;

	/**
	 * @Column(column='metric_value', type='text', mtype='text', nullable=false)
	 */
	public $syst_metric_value;

	/**
	 * @Column(column='metric_type', type='text', mtype='text', nullable=false)
	 */
	public $syst_metric_type;

	/**
	 * @Column(column='recorded_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $syst_recorded_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {

        $this->setSource('system_stats');
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
            'id' => 'syst_id',
			'metric_name' => 'syst_metric_name',
			'metric_value' => 'syst_metric_value',
			'metric_type' => 'syst_metric_type',
			'recorded_at' => 'syst_recorded_at'
        );
    }

}
