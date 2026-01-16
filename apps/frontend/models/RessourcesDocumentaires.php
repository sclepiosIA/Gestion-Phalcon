<?php
use Phalcon\ModelBase;

class RessourcesDocumentaires extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $redo_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $redo_titre;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $redo_description;

	/**
	 * @Column(column='categorie', type='', mtype='enum', nullable=false, key='MUL', 'length': 'guide,fiche_pratique,vulgarisation,video,webinaire,faq')
	 */
	public $redo_categorie;

	/**
	 * @Column(column='sous_categorie', type='text', mtype='text', nullable=true, key='MUL')
	 */
	public $redo_sous_categorie;

	/**
	 * @Column(column='type_fichier', type='', mtype='enum', nullable=false, 'length': 'pdf,video,image,lien_externe,document')
	 */
	public $redo_type_fichier;

	/**
	 * @Column(column='url_fichier', type='text', mtype='text', nullable=true)
	 */
	public $redo_url_fichier;

	/**
	 * @Column(column='storage_path', type='text', mtype='text', nullable=true)
	 */
	public $redo_storage_path;

	/**
	 * @Column(column='taille_ko', type='integer', mtype='int', nullable=true)
	 */
	public $redo_taille_ko;

	/**
	 * @Column(column='visible', type='integer', mtype='tinyint', nullable=true, default='1', key='MUL', 'length': 1)
	 */
	public $redo_visible;

	/**
	 * @Column(column='public', type='integer', mtype='tinyint', nullable=true, default='1', 'length': 1)
	 */
	public $redo_public;

	/**
	 * @Column(column='roles_cibles', type='', mtype='json', nullable=true)
	 */
	public $redo_roles_cibles;

	/**
	 * @Column(column='nombre_telechargements', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $redo_nombre_telechargements;

	/**
	 * @Column(column='nombre_vues', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $redo_nombre_vues;

	/**
	 * @Column(column='ordre', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $redo_ordre;

	/**
	 * @Column(column='tags', type='', mtype='json', nullable=true)
	 */
	public $redo_tags;

	/**
	 * @Column(column='mots_cles', type='', mtype='json', nullable=true)
	 */
	public $redo_mots_cles;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $redo_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $redo_updated_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'RESTRICT', 'length': 36)
	 */
	public $redo_created_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('redo_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));

        $this->setSource('ressources_documentaires');
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
            'id' => 'redo_id',
			'titre' => 'redo_titre',
			'description' => 'redo_description',
			'categorie' => 'redo_categorie',
			'sous_categorie' => 'redo_sous_categorie',
			'type_fichier' => 'redo_type_fichier',
			'url_fichier' => 'redo_url_fichier',
			'storage_path' => 'redo_storage_path',
			'taille_ko' => 'redo_taille_ko',
			'visible' => 'redo_visible',
			'public' => 'redo_public',
			'roles_cibles' => 'redo_roles_cibles',
			'nombre_telechargements' => 'redo_nombre_telechargements',
			'nombre_vues' => 'redo_nombre_vues',
			'ordre' => 'redo_ordre',
			'tags' => 'redo_tags',
			'mots_cles' => 'redo_mots_cles',
			'created_at' => 'redo_created_at',
			'updated_at' => 'redo_updated_at',
			'created_by' => 'redo_created_by'
        );
    }

}
