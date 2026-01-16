<?php
use Phalcon\ModelBase;

class VisioTranscriptionSessions extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $vitrse_id;

	/**
	 * @Column(column='room_code', type='text', mtype='text', nullable=true)
	 */
	public $vitrse_room_code;

	/**
	 * @Column(column='external_meeting_url', type='text', mtype='text', nullable=true)
	 */
	public $vitrse_external_meeting_url;

	/**
	 * @Column(column='title', type='text', mtype='text', nullable=false)
	 */
	public $vitrse_title;

	/**
	 * @Column(column='started_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $vitrse_started_at;

	/**
	 * @Column(column='ended_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $vitrse_ended_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $vitrse_created_by;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $vitrse_etablissement_id;

	/**
	 * @Column(column='partenaire_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $vitrse_partenaire_id;

	/**
	 * @Column(column='groupe_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $vitrse_groupe_id;

	/**
	 * @Column(column='status', type='', mtype='enum', nullable=false, default='active', key='MUL', 'length': 'active,ended,processing,archived')
	 */
	public $vitrse_status;

	/**
	 * @Column(column='summary', type='text', mtype='text', nullable=true)
	 */
	public $vitrse_summary;

	/**
	 * @Column(column='decisions', type='', mtype='json', nullable=true)
	 */
	public $vitrse_decisions;

	/**
	 * @Column(column='next_steps', type='', mtype='json', nullable=true)
	 */
	public $vitrse_next_steps;

	/**
	 * @Column(column='full_transcript', type='text', mtype='longtext', nullable=true)
	 */
	public $vitrse_full_transcript;

	/**
	 * @Column(column='language', type='text', mtype='text', nullable=true)
	 */
	public $vitrse_language;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $vitrse_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $vitrse_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('vitrse_id', 'VisioTranscriptionParticipants', 'vitrpa_session_id', array('alias' => 'visio_transcription_participants_session_id'));
		$this->hasMany('vitrse_id', 'VisioTranscriptionSegments', 'vitrse_session_id', array('alias' => 'visio_transcription_segments_session_id'));

		$this->belongsTo('vitrse_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('vitrse_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));

        $this->setSource('visio_transcription_sessions');
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
            'id' => 'vitrse_id',
			'room_code' => 'vitrse_room_code',
			'external_meeting_url' => 'vitrse_external_meeting_url',
			'title' => 'vitrse_title',
			'started_at' => 'vitrse_started_at',
			'ended_at' => 'vitrse_ended_at',
			'created_by' => 'vitrse_created_by',
			'etablissement_id' => 'vitrse_etablissement_id',
			'partenaire_id' => 'vitrse_partenaire_id',
			'groupe_id' => 'vitrse_groupe_id',
			'status' => 'vitrse_status',
			'summary' => 'vitrse_summary',
			'decisions' => 'vitrse_decisions',
			'next_steps' => 'vitrse_next_steps',
			'full_transcript' => 'vitrse_full_transcript',
			'language' => 'vitrse_language',
			'created_at' => 'vitrse_created_at',
			'updated_at' => 'vitrse_updated_at'
        );
    }

}
