<?
use Phalcon\ModelBase;

class ForumPosts extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $fopo_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $fopo_user_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $fopo_etablissement_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $fopo_titre;

	/**
	 * @Column(column='contenu', type='text', mtype='longtext', nullable=false)
	 */
	public $fopo_contenu;

	/**
	 * @Column(column='theme', type='', mtype='enum', nullable=false, key='MUL', 'length': 'pmsi,smr,urgences,completion_dossier,dictee_vocale,astuces,bugs,support,autre')
	 */
	public $fopo_theme;

	/**
	 * @Column(column='tags', type='', mtype='json', nullable=true)
	 */
	public $fopo_tags;

	/**
	 * @Column(column='visibilite', type='', mtype='enum', nullable=false, default='global', key='MUL', 'length': 'etablissement,global')
	 */
	public $fopo_visibilite;

	/**
	 * @Column(column='upvotes', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $fopo_upvotes;

	/**
	 * @Column(column='nombre_commentaires', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $fopo_nombre_commentaires;

	/**
	 * @Column(column='nombre_vues', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $fopo_nombre_vues;

	/**
	 * @Column(column='epingle', type='integer', mtype='tinyint', nullable=true, default='0', key='MUL', 'length': 1)
	 */
	public $fopo_epingle;

	/**
	 * @Column(column='resolu', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $fopo_resolu;

	/**
	 * @Column(column='archive', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $fopo_archive;

	/**
	 * @Column(column='modere', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $fopo_modere;

	/**
	 * @Column(column='modere_par', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $fopo_modere_par;

	/**
	 * @Column(column='modere_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $fopo_modere_at;

	/**
	 * @Column(column='raison_moderation', type='text', mtype='text', nullable=true)
	 */
	public $fopo_raison_moderation;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $fopo_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $fopo_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('fopo_id', 'ForumComments', 'foco_post_id', array('alias' => 'forum_comments_post_id'));
		$this->hasMany('fopo_id', 'ForumVotes', 'fovo_post_id', array('alias' => 'forum_votes_post_id'));

		$this->belongsTo('fopo_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('fopo_modere_par', 'Profiles', 'pr_id', array('alias' => 'profiles_modere_par'));
		$this->belongsTo('fopo_user_id', 'EtablissementUsers', 'etus_id', array('alias' => 'etablissement_users_user_id'));

        $this->setSource('forum_posts');
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
            'id' => 'fopo_id',
			'user_id' => 'fopo_user_id',
			'etablissement_id' => 'fopo_etablissement_id',
			'titre' => 'fopo_titre',
			'contenu' => 'fopo_contenu',
			'theme' => 'fopo_theme',
			'tags' => 'fopo_tags',
			'visibilite' => 'fopo_visibilite',
			'upvotes' => 'fopo_upvotes',
			'nombre_commentaires' => 'fopo_nombre_commentaires',
			'nombre_vues' => 'fopo_nombre_vues',
			'epingle' => 'fopo_epingle',
			'resolu' => 'fopo_resolu',
			'archive' => 'fopo_archive',
			'modere' => 'fopo_modere',
			'modere_par' => 'fopo_modere_par',
			'modere_at' => 'fopo_modere_at',
			'raison_moderation' => 'fopo_raison_moderation',
			'created_at' => 'fopo_created_at',
			'updated_at' => 'fopo_updated_at'
        );
    }

}
