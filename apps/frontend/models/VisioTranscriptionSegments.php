<?php
use Phalcon\ModelBase;

class VisioTranscriptionSegments extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $vitrse_id;

	/**
	 * @Column(column='session_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $vitrse_session_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $vitrse_user_id;

	/**
	 * @Column(column='speaker_name', type='text', mtype='text', nullable=false)
	 */
	public $vitrse_speaker_name;

	/**
	 * @Column(column='speaker_id', type='text', mtype='text', nullable=true)
	 */
	public $vitrse_speaker_id;

	/**
	 * @Column(column='text', type='text', mtype='text', nullable=false)
	 */
	public $vitrse_text;

	/**
	 * @Column(column='start_time_ms', type='integer', mtype='bigint', nullable=true)
	 */
	public $vitrse_start_time_ms;

	/**
	 * @Column(column='end_time_ms', type='integer', mtype='bigint', nullable=true)
	 */
	public $vitrse_end_time_ms;

	/**
	 * @Column(column='is_partial', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $vitrse_is_partial;

	/**
	 * @Column(column='confidence', type='double', mtype='double', nullable=true)
	 */
	public $vitrse_confidence;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $vitrse_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('vitrse_session_id', 'VisioTranscriptionSessions', 'vitrse_id', array('alias' => 'visio_transcription_sessions_session_id'));
		$this->belongsTo('vitrse_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('visio_transcription_segments');
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
			'session_id' => 'vitrse_session_id',
			'user_id' => 'vitrse_user_id',
			'speaker_name' => 'vitrse_speaker_name',
			'speaker_id' => 'vitrse_speaker_id',
			'text' => 'vitrse_text',
			'start_time_ms' => 'vitrse_start_time_ms',
			'end_time_ms' => 'vitrse_end_time_ms',
			'is_partial' => 'vitrse_is_partial',
			'confidence' => 'vitrse_confidence',
			'created_at' => 'vitrse_created_at'
        );
    }

}
