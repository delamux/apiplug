<?php
use Migrations\AbstractMigration;

class AddBlog extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('posts')
            ->addColumn('user_id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('title', 'string', [
                'null' => true,
                'default' => null,
                'length' => 255
            ])
            ->addColumn('body', 'text', [
                'null' => true,
                'default' => null
            ])
            ->addTimestamps('created', 'modified')
            ->create();

        $this->table('posts')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('comments')
            ->addColumn('post_id', 'integer', [
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('comment', 'text', [
                'null' => true,
                'default' => null
            ])
            ->create();

        $this->table('comments')
            ->addForeignKey(
                'post_id',
                'posts',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }
}
