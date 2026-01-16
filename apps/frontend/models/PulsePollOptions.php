<?php
use Phalcon\ModelBase;

class PulsePollOptions extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pupoop_id;

	/**
	 * @Column(column='poll_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pupoop_poll_id;

	/**
	 * @Column(column='text', type='text', mtype='longtext', nullable=false)
	 */
	public $pupoop_text;

	/**
	 * @Column(column='position', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $pupoop_position;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pupoop_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('pupoop_id', 'PulsePollVotes', 'pupovo_option_id', array('alias' => 'pulse_poll_votes_option_id'));

		$this->belongsTo('pupoop_poll_id', 'PulsePolls', 'pupo_id', array('alias' => 'pulse_polls_poll_id'));

        $this->setSource('pulse_poll_options');
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
            'id' => 'pupoop_id',
			'poll_id' => 'pupoop_poll_id',
			'text' => 'pupoop_text',
			'position' => 'pupoop_position',
			'created_at' => 'pupoop_created_at'
        );
    }

}
