<?
use Phalcon\ModelBase;

class NotificationsHistory extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $nohi_id;

	/**
	 * @Column(column='rule_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $nohi_rule_id;

	/**
	 * @Column(column='event_type', type='text', mtype='text', nullable=false)
	 */
	public $nohi_event_type;

	/**
	 * @Column(column='recipient_email', type='text', mtype='text', nullable=false)
	 */
	public $nohi_recipient_email;

	/**
	 * @Column(column='subject', type='text', mtype='text', nullable=false)
	 */
	public $nohi_subject;

	/**
	 * @Column(column='content', type='text', mtype='text', nullable=false)
	 */
	public $nohi_content;

	/**
	 * @Column(column='status', type='string', mtype='varchar', nullable=false, default='sent', 'length': 16)
	 */
	public $nohi_status;

	/**
	 * @Column(column='error_message', type='text', mtype='text', nullable=true)
	 */
	public $nohi_error_message;

	/**
	 * @Column(column='sent_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $nohi_sent_at;

	/**
	 * @Column(column='metadata', type='', mtype='json', nullable=true)
	 */
	public $nohi_metadata;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('nohi_rule_id', 'NotificationsRules', 'noru_id', array('alias' => 'notifications_rules_rule_id'));

        $this->setSource('notifications_history');
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
            'id' => 'nohi_id',
			'rule_id' => 'nohi_rule_id',
			'event_type' => 'nohi_event_type',
			'recipient_email' => 'nohi_recipient_email',
			'subject' => 'nohi_subject',
			'content' => 'nohi_content',
			'status' => 'nohi_status',
			'error_message' => 'nohi_error_message',
			'sent_at' => 'nohi_sent_at',
			'metadata' => 'nohi_metadata'
        );
    }

}
