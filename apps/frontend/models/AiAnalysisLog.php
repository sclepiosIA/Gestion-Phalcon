<?
use Phalcon\ModelBase;

class AiAnalysisLog extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $aianlo_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $aianlo_user_id;

	/**
	 * @Column(column='analysis_type', type='string', mtype='varchar', nullable=false, 'length': 100)
	 */
	public $aianlo_analysis_type;

	/**
	 * @Column(column='filters', type='', mtype='json', nullable=true)
	 */
	public $aianlo_filters;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $aianlo_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('aianlo_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('ai_analysis_log');
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
            'id' => 'aianlo_id',
			'user_id' => 'aianlo_user_id',
			'analysis_type' => 'aianlo_analysis_type',
			'filters' => 'aianlo_filters',
			'created_at' => 'aianlo_created_at'
        );
    }

}
