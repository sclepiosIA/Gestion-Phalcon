<?
use Phalcon\ModelBase;

class AiProcessingLog extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $aiprlo_id;

	/**
	 * @Column(column='email_thread_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $aiprlo_email_thread_id;

	/**
	 * @Column(column='processing_type', type='text', mtype='text', nullable=false)
	 */
	public $aiprlo_processing_type;

	/**
	 * @Column(column='model_used', type='text', mtype='text', nullable=false)
	 */
	public $aiprlo_model_used;

	/**
	 * @Column(column='prompt_tokens', type='integer', mtype='int', nullable=true)
	 */
	public $aiprlo_prompt_tokens;

	/**
	 * @Column(column='completion_tokens', type='integer', mtype='int', nullable=true)
	 */
	public $aiprlo_completion_tokens;

	/**
	 * @Column(column='total_tokens', type='integer', mtype='int', nullable=true)
	 */
	public $aiprlo_total_tokens;

	/**
	 * @Column(column='result', type='', mtype='json', nullable=true)
	 */
	public $aiprlo_result;

	/**
	 * @Column(column='confidence_score', type='decimal', mtype='decimal', nullable=true, 'length': 3)
	 */
	public $aiprlo_confidence_score;

	/**
	 * @Column(column='success', type='integer', mtype='tinyint', nullable=false, 'length': 1)
	 */
	public $aiprlo_success;

	/**
	 * @Column(column='error_message', type='text', mtype='text', nullable=true)
	 */
	public $aiprlo_error_message;

	/**
	 * @Column(column='processing_duration_ms', type='integer', mtype='int', nullable=true)
	 */
	public $aiprlo_processing_duration_ms;

	/**
	 * @Column(column='processed_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $aiprlo_processed_at;

	/**
	 * @Column(column='processed_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $aiprlo_processed_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('aiprlo_processed_by', 'Profiles', 'pr_id', array('alias' => 'profiles_processed_by'));
		$this->belongsTo('aiprlo_email_thread_id', 'EmailThreads', 'emth_id', array('alias' => 'email_threads_email_thread_id'));

        $this->setSource('ai_processing_log');
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
            'id' => 'aiprlo_id',
			'email_thread_id' => 'aiprlo_email_thread_id',
			'processing_type' => 'aiprlo_processing_type',
			'model_used' => 'aiprlo_model_used',
			'prompt_tokens' => 'aiprlo_prompt_tokens',
			'completion_tokens' => 'aiprlo_completion_tokens',
			'total_tokens' => 'aiprlo_total_tokens',
			'result' => 'aiprlo_result',
			'confidence_score' => 'aiprlo_confidence_score',
			'success' => 'aiprlo_success',
			'error_message' => 'aiprlo_error_message',
			'processing_duration_ms' => 'aiprlo_processing_duration_ms',
			'processed_at' => 'aiprlo_processed_at',
			'processed_by' => 'aiprlo_processed_by'
        );
    }

}
