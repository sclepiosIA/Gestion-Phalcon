<?
use Phalcon\ModelBase;

class EmailToEtablissementSuggestions extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $emtoetsu_id;

	/**
	 * @Column(column='email_thread_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $emtoetsu_email_thread_id;

	/**
	 * @Column(column='suggestion_type', type='text', mtype='text', nullable=false)
	 */
	public $emtoetsu_suggestion_type;

	/**
	 * @Column(column='suggested_etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emtoetsu_suggested_etablissement_id;

	/**
	 * @Column(column='match_confidence', type='decimal', mtype='decimal', nullable=true, 'length': 3)
	 */
	public $emtoetsu_match_confidence;

	/**
	 * @Column(column='match_reason', type='text', mtype='text', nullable=true)
	 */
	public $emtoetsu_match_reason;

	/**
	 * @Column(column='extracted_data', type='', mtype='json', nullable=true)
	 */
	public $emtoetsu_extracted_data;

	/**
	 * @Column(column='status', type='text', mtype='text', nullable=false, key='MUL')
	 */
	public $emtoetsu_status;

	/**
	 * @Column(column='reviewed_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emtoetsu_reviewed_by;

	/**
	 * @Column(column='reviewed_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $emtoetsu_reviewed_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $emtoetsu_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('emtoetsu_suggested_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_suggested_etablissement_id'));
		$this->belongsTo('emtoetsu_reviewed_by', 'Profiles', 'pr_id', array('alias' => 'profiles_reviewed_by'));
		$this->belongsTo('emtoetsu_email_thread_id', 'EmailThreads', 'emth_id', array('alias' => 'email_threads_email_thread_id'));

        $this->setSource('email_to_etablissement_suggestions');
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
            'id' => 'emtoetsu_id',
			'email_thread_id' => 'emtoetsu_email_thread_id',
			'suggestion_type' => 'emtoetsu_suggestion_type',
			'suggested_etablissement_id' => 'emtoetsu_suggested_etablissement_id',
			'match_confidence' => 'emtoetsu_match_confidence',
			'match_reason' => 'emtoetsu_match_reason',
			'extracted_data' => 'emtoetsu_extracted_data',
			'status' => 'emtoetsu_status',
			'reviewed_by' => 'emtoetsu_reviewed_by',
			'reviewed_at' => 'emtoetsu_reviewed_at',
			'created_at' => 'emtoetsu_created_at'
        );
    }

}
