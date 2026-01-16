<?php
use Phalcon\ModelBase;

class TachesDocuments extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $tado_id;

	/**
	 * @Column(column='tache_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $tado_tache_id;

	/**
	 * @Column(column='nom_fichier', type='text', mtype='text', nullable=false)
	 */
	public $tado_nom_fichier;

	/**
	 * @Column(column='chemin_fichier', type='text', mtype='text', nullable=false)
	 */
	public $tado_chemin_fichier;

	/**
	 * @Column(column='type_mime', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $tado_type_mime;

	/**
	 * @Column(column='taille_fichier', type='integer', mtype='bigint', nullable=true)
	 */
	public $tado_taille_fichier;

	/**
	 * @Column(column='uploaded_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $tado_uploaded_by;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $tado_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $tado_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('tado_tache_id', 'Taches', 'ta_id', array('alias' => 'taches_tache_id'));
		$this->belongsTo('tado_uploaded_by', 'Profiles', 'pr_id', array('alias' => 'profiles_uploaded_by'));

        $this->setSource('taches_documents');
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
            'id' => 'tado_id',
			'tache_id' => 'tado_tache_id',
			'nom_fichier' => 'tado_nom_fichier',
			'chemin_fichier' => 'tado_chemin_fichier',
			'type_mime' => 'tado_type_mime',
			'taille_fichier' => 'tado_taille_fichier',
			'uploaded_by' => 'tado_uploaded_by',
			'created_at' => 'tado_created_at',
			'updated_at' => 'tado_updated_at'
        );
    }

}
