<?
use Phalcon\ModelBase;

class PulseAiResponses extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $puaire_id;

	/**
	 * @Column(column='original_message_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $puaire_original_message_id;

	/**
	 * @Column(column='conversation_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $puaire_conversation_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $puaire_user_id;

	/**
	 * @Column(column='prompt', type='text', mtype='text', nullable=false)
	 */
	public $puaire_prompt;

	/**
	 * @Column(column='response_text', type='text', mtype='text', nullable=false)
	 */
	public $puaire_response_text;

	/**
	 * @Column(column='model', type='text', mtype='text', nullable=false)
	 */
	public $puaire_model;

	/**
	 * @Column(column='tokens_input', type='integer', mtype='int', nullable=true)
	 */
	public $puaire_tokens_input;

	/**
	 * @Column(column='tokens_output', type='integer', mtype='int', nullable=true)
	 */
	public $puaire_tokens_output;

	/**
	 * @Column(column='processing_time_ms', type='integer', mtype='int', nullable=true)
	 */
	public $puaire_processing_time_ms;

	/**
	 * @Column(column='user_accepted', type='integer', mtype='tinyint', nullable=true, 'length': 1)
	 */
	public $puaire_user_accepted;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $puaire_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('puaire_conversation_id', 'PulseConversations', 'puco_id', array('alias' => 'pulse_conversations_conversation_id'));
		$this->belongsTo('puaire_original_message_id', 'PulseMessages', 'pume_id', array('alias' => 'pulse_messages_original_message_id'));
		$this->belongsTo('puaire_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('pulse_ai_responses');
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
            'id' => 'puaire_id',
			'original_message_id' => 'puaire_original_message_id',
			'conversation_id' => 'puaire_conversation_id',
			'user_id' => 'puaire_user_id',
			'prompt' => 'puaire_prompt',
			'response_text' => 'puaire_response_text',
			'model' => 'puaire_model',
			'tokens_input' => 'puaire_tokens_input',
			'tokens_output' => 'puaire_tokens_output',
			'processing_time_ms' => 'puaire_processing_time_ms',
			'user_accepted' => 'puaire_user_accepted',
			'created_at' => 'puaire_created_at'
        );
    }

}
