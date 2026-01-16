<?
use Phalcon\ModelBase;

class ForumVotes extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $fovo_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $fovo_user_id;

	/**
	 * @Column(column='post_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $fovo_post_id;

	/**
	 * @Column(column='comment_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $fovo_comment_id;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $fovo_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('fovo_comment_id', 'ForumComments', 'foco_id', array('alias' => 'forum_comments_comment_id'));
		$this->belongsTo('fovo_post_id', 'ForumPosts', 'fopo_id', array('alias' => 'forum_posts_post_id'));
		$this->belongsTo('fovo_user_id', 'EtablissementUsers', 'etus_id', array('alias' => 'etablissement_users_user_id'));

        $this->setSource('forum_votes');
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
            'id' => 'fovo_id',
			'user_id' => 'fovo_user_id',
			'post_id' => 'fovo_post_id',
			'comment_id' => 'fovo_comment_id',
			'created_at' => 'fovo_created_at'
        );
    }

}
