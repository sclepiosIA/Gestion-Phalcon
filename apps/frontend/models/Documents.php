<?php
use Phalcon\ModelBase;

class Documents extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $do_id;

	/**
	 * @Column(column='name', type='text', mtype='text', nullable=false)
	 */
	public $do_name;

	/**
	 * @Column(column='file_size_bytes', type='integer', mtype='bigint', nullable=false)
	 */
	public $do_file_size_bytes;

	/**
	 * @Column(column='mime_type', type='text', mtype='text', nullable=false)
	 */
	public $do_mime_type;

	/**
	 * @Column(column='storage_path', type='text', mtype='text', nullable=false, key='UNI')
	 */
	public $do_storage_path;

	/**
	 * @Column(column='storage_bucket', type='text', mtype='text', nullable=false)
	 */
	public $do_storage_bucket;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $do_description;

	/**
	 * @Column(column='tags', type='', mtype='json', nullable=true)
	 */
	public $do_tags;

	/**
	 * @Column(column='source_type', type='', mtype='enum', nullable=true, 'length': 'direct_upload,migrated_tache,migrated_rh,migrated_email,migrated_rd,migrated_onboarding')
	 */
	public $do_source_type;

	/**
	 * @Column(column='source_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $do_source_id;

	/**
	 * @Column(column='version_number', type='integer', mtype='int', nullable=true, default='1')
	 */
	public $do_version_number;

	/**
	 * @Column(column='is_latest', type='integer', mtype='tinyint', nullable=true, default='1', 'length': 1)
	 */
	public $do_is_latest;

	/**
	 * @Column(column='replaces_document_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $do_replaces_document_id;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $do_created_by;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', key='MUL')
	 */
	public $do_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $do_updated_at;

	/**
	 * @Column(column='deleted_at', type='datetime', mtype='datetime', nullable=true, key='MUL')
	 */
	public $do_deleted_at;

	/**
	 * @Column(column='deleted_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $do_deleted_by;

	/**
	 * @Column(column='is_hard_deleted', type='integer', mtype='tinyint', nullable=true, default='0', key='MUL', 'length': 1)
	 */
	public $do_is_hard_deleted;

	/**
	 * @Column(column='folder_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $do_folder_id;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('do_id', 'DocumentAuditLog', 'doaulo_document_id', array('alias' => 'document_audit_log_document_id'));
		$this->hasMany('do_id', 'DocumentRelations', 'dore_document_id', array('alias' => 'document_relations_document_id'));
		$this->hasMany('do_id', 'DocumentShares', 'dosh_document_id', array('alias' => 'document_shares_document_id'));
		$this->hasMany('do_id', 'Documents', 'do_replaces_document_id', array('alias' => 'documents_replaces_document_id'));

		$this->belongsTo('do_created_by', 'Users', 'us_id', array('alias' => 'users_created_by'));
		$this->belongsTo('do_deleted_by', 'Users', 'us_id', array('alias' => 'users_deleted_by'));
		$this->belongsTo('do_folder_id', 'DocumentFolders', 'dofo_id', array('alias' => 'document_folders_folder_id'));
		$this->belongsTo('do_replaces_document_id', 'Documents', 'do_id', array('alias' => 'documents_replaces_document_id'));

        $this->setSource('documents');
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
            'id' => 'do_id',
			'name' => 'do_name',
			'file_size_bytes' => 'do_file_size_bytes',
			'mime_type' => 'do_mime_type',
			'storage_path' => 'do_storage_path',
			'storage_bucket' => 'do_storage_bucket',
			'description' => 'do_description',
			'tags' => 'do_tags',
			'source_type' => 'do_source_type',
			'source_id' => 'do_source_id',
			'version_number' => 'do_version_number',
			'is_latest' => 'do_is_latest',
			'replaces_document_id' => 'do_replaces_document_id',
			'created_by' => 'do_created_by',
			'created_at' => 'do_created_at',
			'updated_at' => 'do_updated_at',
			'deleted_at' => 'do_deleted_at',
			'deleted_by' => 'do_deleted_by',
			'is_hard_deleted' => 'do_is_hard_deleted',
			'folder_id' => 'do_folder_id'
        );
    }

}
