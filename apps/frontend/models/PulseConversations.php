<?php
use Phalcon\ModelBase;

class PulseConversations extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $puco_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $puco_etablissement_id;

	/**
	 * @Column(column='name', type='string', mtype='varchar', nullable=false, 'length': 255)
	 */
	public $puco_name;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $puco_description;

	/**
	 * @Column(column='visibility', type='', mtype='enum', nullable=false, default='private', 'length': 'private,public')
	 */
	public $puco_visibility;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $puco_created_by;

	/**
	 * @Column(column='is_archived', type='integer', mtype='tinyint', nullable=false, default='0', key='MUL', 'length': 1)
	 */
	public $puco_is_archived;

	/**
	 * @Column(column='archived_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $puco_archived_at;

	/**
	 * @Column(column='archived_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $puco_archived_by;

	/**
	 * @Column(column='metadata', type='', mtype='json', nullable=true)
	 */
	public $puco_metadata;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $puco_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $puco_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('puco_id', 'PulseAiResponses', 'puaire_conversation_id', array('alias' => 'pulse_ai_responses_conversation_id'));
		$this->hasMany('puco_id', 'PulseConversationMembers', 'pucome_conversation_id', array('alias' => 'pulse_conversation_members_conversation_id'));
		$this->hasMany('puco_id', 'PulseMessageTaskLinks', 'pumetali_conversation_id', array('alias' => 'pulse_message_task_links_conversation_id'));
		$this->hasMany('puco_id', 'PulseMessages', 'pume_conversation_id', array('alias' => 'pulse_messages_conversation_id'));
		$this->hasMany('puco_id', 'PulsePolls', 'pupo_conversation_id', array('alias' => 'pulse_polls_conversation_id'));
		$this->hasMany('puco_id', 'PulsePresence', 'pupr_conversation_id', array('alias' => 'pulse_presence_conversation_id'));
		$this->hasMany('puco_id', 'Taches', 'ta_pulse_conversation_id', array('alias' => 'taches_pulse_conversation_id'));

		$this->belongsTo('puco_archived_by', 'Profiles', 'pr_id', array('alias' => 'profiles_archived_by'));
		$this->belongsTo('puco_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('puco_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));

        $this->setSource('pulse_conversations');
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
            'id' => 'puco_id',
			'etablissement_id' => 'puco_etablissement_id',
			'name' => 'puco_name',
			'description' => 'puco_description',
			'visibility' => 'puco_visibility',
			'created_by' => 'puco_created_by',
			'is_archived' => 'puco_is_archived',
			'archived_at' => 'puco_archived_at',
			'archived_by' => 'puco_archived_by',
			'metadata' => 'puco_metadata',
			'created_at' => 'puco_created_at',
			'updated_at' => 'puco_updated_at'
        );
    }

}
