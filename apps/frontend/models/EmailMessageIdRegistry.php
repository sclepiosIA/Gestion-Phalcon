<?
use Phalcon\ModelBase;

class EmailMessageIdRegistry extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='message_id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 255)
	 */
	public $emmeidre_message_id;

	/**
	 * @Column(column='first_seen_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $emmeidre_first_seen_at;

	/**
	 * @Column(column='processed_for_ai', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $emmeidre_processed_for_ai;

	/**
	 * @Column(column='processed_for_support', type='integer', mtype='tinyint', nullable=false, default='0', 'length': 1)
	 */
	public $emmeidre_processed_for_support;

	/**
	 * @Column(column='source_thread_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emmeidre_source_thread_id;

	/**
	 * @Column(column='source_account_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emmeidre_source_account_id;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('emmeidre_source_account_id', 'UserEmailAccounts', 'usemac_id', array('alias' => 'user_email_accounts_source_account_id'));
		$this->belongsTo('emmeidre_source_thread_id', 'EmailThreads', 'emth_id', array('alias' => 'email_threads_source_thread_id'));

        $this->setSource('email_message_id_registry');
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
            'message_id' => 'emmeidre_message_id',
			'first_seen_at' => 'emmeidre_first_seen_at',
			'processed_for_ai' => 'emmeidre_processed_for_ai',
			'processed_for_support' => 'emmeidre_processed_for_support',
			'source_thread_id' => 'emmeidre_source_thread_id',
			'source_account_id' => 'emmeidre_source_account_id'
        );
    }

}
