<?
use Phalcon\ModelBase;

class DocumentAuditLog extends ModelBase
{
    
	/**
	 * @Primary
	 * @Identity
	 * @Column(column='id', type='integer', mtype='bigint', nullable=false, extra='auto_increment', key='PRI')
	 */
	public $doaulo_id;

	/**
	 * @Column(column='document_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $doaulo_document_id;

	/**
	 * @Column(column='action', type='', mtype='enum', nullable=false, key='MUL', 'length': 'created,updated,renamed,downloaded,viewed,shared,unshared,permission_changed,deleted,restored,hard_deleted,version_created,tagged,relation_added,relation_removed')
	 */
	public $doaulo_action;

	/**
	 * @Column(column='performed_by', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $doaulo_performed_by;

	/**
	 * @Column(column='ip_address', type='string', mtype='varchar', nullable=true, 'length': 45)
	 */
	public $doaulo_ip_address;

	/**
	 * @Column(column='user_agent', type='text', mtype='text', nullable=true)
	 */
	public $doaulo_user_agent;

	/**
	 * @Column(column='old_value', type='', mtype='json', nullable=true)
	 */
	public $doaulo_old_value;

	/**
	 * @Column(column='new_value', type='', mtype='json', nullable=true)
	 */
	public $doaulo_new_value;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $doaulo_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('doaulo_document_id', 'Documents', 'do_id', array('alias' => 'documents_document_id'));
		$this->belongsTo('doaulo_performed_by', 'Users', 'us_id', array('alias' => 'users_performed_by'));

        $this->setSource('document_audit_log');
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
            'id' => 'doaulo_id',
			'document_id' => 'doaulo_document_id',
			'action' => 'doaulo_action',
			'performed_by' => 'doaulo_performed_by',
			'ip_address' => 'doaulo_ip_address',
			'user_agent' => 'doaulo_user_agent',
			'old_value' => 'doaulo_old_value',
			'new_value' => 'doaulo_new_value',
			'created_at' => 'doaulo_created_at'
        );
    }

}
