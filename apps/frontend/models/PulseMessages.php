<?
use Phalcon\ModelBase;

class PulseMessages extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pume_id;

	/**
	 * @Column(column='conversation_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pume_conversation_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pume_user_id;

	/**
	 * @Column(column='content', type='text', mtype='text', nullable=false)
	 */
	public $pume_content;

	/**
	 * @Column(column='content_html', type='text', mtype='longtext', nullable=true)
	 */
	public $pume_content_html;

	/**
	 * @Column(column='parent_message_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pume_parent_message_id;

	/**
	 * @Column(column='message_type', type='', mtype='enum', nullable=false, default='text', 'length': 'text,system,ai_suggestion,task_update')
	 */
	public $pume_message_type;

	/**
	 * @Column(column='edited_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $pume_edited_at;

	/**
	 * @Column(column='edited_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pume_edited_by;

	/**
	 * @Column(column='edit_count', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $pume_edit_count;

	/**
	 * @Column(column='deleted_at', type='datetime', mtype='datetime', nullable=true, key='MUL')
	 */
	public $pume_deleted_at;

	/**
	 * @Column(column='deleted_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $pume_deleted_by;

	/**
	 * @Column(column='deletion_reason', type='text', mtype='text', nullable=true)
	 */
	public $pume_deletion_reason;

	/**
	 * @Column(column='ai_processed', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $pume_ai_processed;

	/**
	 * @Column(column='reaction_count', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $pume_reaction_count;

	/**
	 * @Column(column='reply_count', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $pume_reply_count;

	/**
	 * @Column(column='mentions', type='', mtype='json', nullable=true)
	 */
	public $pume_mentions;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pume_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('pume_id', 'PulseAiResponses', 'puaire_original_message_id', array('alias' => 'pulse_ai_responses_original_message_id'));
		$this->hasMany('pume_id', 'PulseMedia', 'pume_message_id', array('alias' => 'pulse_media_message_id'));
		$this->hasMany('pume_id', 'PulseMessageTaskLinks', 'pumetali_message_id', array('alias' => 'pulse_message_task_links_message_id'));
		$this->hasMany('pume_id', 'PulseMessages', 'pume_parent_message_id', array('alias' => 'pulse_messages_parent_message_id'));
		$this->hasMany('pume_id', 'PulsePolls', 'pupo_message_id', array('alias' => 'pulse_polls_message_id'));
		$this->hasMany('pume_id', 'PulseReactions', 'pure_message_id', array('alias' => 'pulse_reactions_message_id'));

		$this->belongsTo('pume_conversation_id', 'PulseConversations', 'puco_id', array('alias' => 'pulse_conversations_conversation_id'));
		$this->belongsTo('pume_deleted_by', 'Profiles', 'pr_id', array('alias' => 'profiles_deleted_by'));
		$this->belongsTo('pume_edited_by', 'Profiles', 'pr_id', array('alias' => 'profiles_edited_by'));
		$this->belongsTo('pume_parent_message_id', 'PulseMessages', 'pume_id', array('alias' => 'pulse_messages_parent_message_id'));
		$this->belongsTo('pume_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('pulse_messages');
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
            'id' => 'pume_id',
			'conversation_id' => 'pume_conversation_id',
			'user_id' => 'pume_user_id',
			'content' => 'pume_content',
			'content_html' => 'pume_content_html',
			'parent_message_id' => 'pume_parent_message_id',
			'message_type' => 'pume_message_type',
			'edited_at' => 'pume_edited_at',
			'edited_by' => 'pume_edited_by',
			'edit_count' => 'pume_edit_count',
			'deleted_at' => 'pume_deleted_at',
			'deleted_by' => 'pume_deleted_by',
			'deletion_reason' => 'pume_deletion_reason',
			'ai_processed' => 'pume_ai_processed',
			'reaction_count' => 'pume_reaction_count',
			'reply_count' => 'pume_reply_count',
			'mentions' => 'pume_mentions',
			'created_at' => 'pume_created_at'
        );
    }

}
