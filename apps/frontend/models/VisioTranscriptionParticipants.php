<?
use Phalcon\ModelBase;

class VisioTranscriptionParticipants extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $vitrpa_id;

	/**
	 * @Column(column='session_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $vitrpa_session_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $vitrpa_user_id;

	/**
	 * @Column(column='display_name', type='text', mtype='text', nullable=false)
	 */
	public $vitrpa_display_name;

	/**
	 * @Column(column='azure_speaker_id', type='text', mtype='text', nullable=true)
	 */
	public $vitrpa_azure_speaker_id;

	/**
	 * @Column(column='joined_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $vitrpa_joined_at;

	/**
	 * @Column(column='left_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $vitrpa_left_at;

	/**
	 * @Column(column='is_transcribing', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $vitrpa_is_transcribing;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('vitrpa_session_id', 'VisioTranscriptionSessions', 'vitrse_id', array('alias' => 'visio_transcription_sessions_session_id'));
		$this->belongsTo('vitrpa_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('visio_transcription_participants');
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
            'id' => 'vitrpa_id',
			'session_id' => 'vitrpa_session_id',
			'user_id' => 'vitrpa_user_id',
			'display_name' => 'vitrpa_display_name',
			'azure_speaker_id' => 'vitrpa_azure_speaker_id',
			'joined_at' => 'vitrpa_joined_at',
			'left_at' => 'vitrpa_left_at',
			'is_transcribing' => 'vitrpa_is_transcribing'
        );
    }

}
