<?
use Phalcon\ModelBase;

class AiSuggestedActions extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $aisuac_id;

	/**
	 * @Column(column='email_thread_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $aisuac_email_thread_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $aisuac_etablissement_id;

	/**
	 * @Column(column='action_type', type='', mtype='enum', nullable=false, 'length': 'update_task,create_task,change_status,update_summary')
	 */
	public $aisuac_action_type;

	/**
	 * @Column(column='action_data', type='', mtype='json', nullable=false)
	 */
	public $aisuac_action_data;

	/**
	 * @Column(column='confidence_score', type='decimal', mtype='decimal', nullable=true, 'length': 3)
	 */
	public $aisuac_confidence_score;

	/**
	 * @Column(column='status', type='', mtype='enum', nullable=false, default='pending', key='MUL', 'length': 'pending,approved,rejected')
	 */
	public $aisuac_status;

	/**
	 * @Column(column='reviewed_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $aisuac_reviewed_by;

	/**
	 * @Column(column='reviewed_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $aisuac_reviewed_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $aisuac_created_at;

	/**
	 * @Column(column='reason', type='text', mtype='text', nullable=true)
	 */
	public $aisuac_reason;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('aisuac_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('aisuac_reviewed_by', 'Profiles', 'pr_id', array('alias' => 'profiles_reviewed_by'));
		$this->belongsTo('aisuac_email_thread_id', 'EmailThreads', 'emth_id', array('alias' => 'email_threads_email_thread_id'));

        $this->setSource('ai_suggested_actions');
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
            'id' => 'aisuac_id',
			'email_thread_id' => 'aisuac_email_thread_id',
			'etablissement_id' => 'aisuac_etablissement_id',
			'action_type' => 'aisuac_action_type',
			'action_data' => 'aisuac_action_data',
			'confidence_score' => 'aisuac_confidence_score',
			'status' => 'aisuac_status',
			'reviewed_by' => 'aisuac_reviewed_by',
			'reviewed_at' => 'aisuac_reviewed_at',
			'created_at' => 'aisuac_created_at',
			'reason' => 'aisuac_reason'
        );
    }

}
