<?
use Phalcon\ModelBase;

class PulsePollVotes extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $pupovo_id;

	/**
	 * @Column(column='poll_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pupovo_poll_id;

	/**
	 * @Column(column='option_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pupovo_option_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $pupovo_user_id;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $pupovo_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('pupovo_option_id', 'PulsePollOptions', 'pupoop_id', array('alias' => 'pulse_poll_options_option_id'));
		$this->belongsTo('pupovo_poll_id', 'PulsePolls', 'pupo_id', array('alias' => 'pulse_polls_poll_id'));
		$this->belongsTo('pupovo_user_id', 'Profiles', 'pr_id', array('alias' => 'profiles_user_id'));

        $this->setSource('pulse_poll_votes');
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
            'id' => 'pupovo_id',
			'poll_id' => 'pupovo_poll_id',
			'option_id' => 'pupovo_option_id',
			'user_id' => 'pupovo_user_id',
			'created_at' => 'pupovo_created_at'
        );
    }

}
