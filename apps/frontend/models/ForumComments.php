<?php
use Phalcon\ModelBase;

class ForumComments extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $foco_id;

	/**
	 * @Column(column='post_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $foco_post_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $foco_user_id;

	/**
	 * @Column(column='parent_comment_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $foco_parent_comment_id;

	/**
	 * @Column(column='contenu', type='text', mtype='longtext', nullable=false)
	 */
	public $foco_contenu;

	/**
	 * @Column(column='upvotes', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $foco_upvotes;

	/**
	 * @Column(column='modere', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $foco_modere;

	/**
	 * @Column(column='modere_par', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $foco_modere_par;

	/**
	 * @Column(column='modere_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $foco_modere_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $foco_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $foco_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('foco_id', 'ForumComments', 'foco_parent_comment_id', array('alias' => 'forum_comments_parent_comment_id'));
		$this->hasMany('foco_id', 'ForumVotes', 'fovo_comment_id', array('alias' => 'forum_votes_comment_id'));

		$this->belongsTo('foco_modere_par', 'Profiles', 'pr_id', array('alias' => 'profiles_modere_par'));
		$this->belongsTo('foco_parent_comment_id', 'ForumComments', 'foco_id', array('alias' => 'forum_comments_parent_comment_id'));
		$this->belongsTo('foco_post_id', 'ForumPosts', 'fopo_id', array('alias' => 'forum_posts_post_id'));
		$this->belongsTo('foco_user_id', 'EtablissementUsers', 'etus_id', array('alias' => 'etablissement_users_user_id'));

        $this->setSource('forum_comments');
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
            'id' => 'foco_id',
			'post_id' => 'foco_post_id',
			'user_id' => 'foco_user_id',
			'parent_comment_id' => 'foco_parent_comment_id',
			'contenu' => 'foco_contenu',
			'upvotes' => 'foco_upvotes',
			'modere' => 'foco_modere',
			'modere_par' => 'foco_modere_par',
			'modere_at' => 'foco_modere_at',
			'created_at' => 'foco_created_at',
			'updated_at' => 'foco_updated_at'
        );
    }

}
