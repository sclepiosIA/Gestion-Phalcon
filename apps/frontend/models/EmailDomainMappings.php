<?
use Phalcon\ModelBase;

class EmailDomainMappings extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $emdoma_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $emdoma_etablissement_id;

	/**
	 * @Column(column='domain', type='string', mtype='varchar', nullable=false, key='UNI', 'length': 255)
	 */
	public $emdoma_domain;

	/**
	 * @Column(column='confidence_level', type='string', mtype='varchar', nullable=false, default='high', 'length': 10)
	 */
	public $emdoma_confidence_level;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $emdoma_created_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emdoma_created_by;

	/**
	 * @Column(column='verified', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $emdoma_verified;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('emdoma_created_by', 'Users', 'us_id', array('alias' => 'users_created_by'));
		$this->belongsTo('emdoma_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));

        $this->setSource('email_domain_mappings');
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
            'id' => 'emdoma_id',
			'etablissement_id' => 'emdoma_etablissement_id',
			'domain' => 'emdoma_domain',
			'confidence_level' => 'emdoma_confidence_level',
			'created_at' => 'emdoma_created_at',
			'created_by' => 'emdoma_created_by',
			'verified' => 'emdoma_verified'
        );
    }

}
