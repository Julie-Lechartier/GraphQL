<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\Like;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $users = [];
        $now = new \DateTimeImmutable();

        //user
        for ($i = 1; $i <= 50; $i++) {
            $user = (new User())
                ->setFirstName('User'.$i)
                ->setLastName('Test'.$i)
                ->setEmail('user'.$i.'@example.com')
                ->setPassword('password')
                ->setCreatedAt($now);

            $manager->persist($user);
            $users[] = $user;
        }

        // follow
        $userCount = \count($users);
        foreach ($users as $index => $user) {
            for ($j = 1; $j <= 3; $j++) {
                $followIndex = ($index + $j) % $userCount;
                $user->addFollowing($users[$followIndex]);
            }
        }

        foreach ($users as $author) {
            // post
            $postCount = random_int(1, 10);

            for ($p = 0; $p < $postCount; $p++) {
                $post = new Post();
                $post->setContent(sprintf('Post %d de %s', $p + 1, $author->getFirstName()));
                $post->setCreatedAt($now);
                $post->setAuthor($author);

                $manager->persist($post);

                // Comments
                $commentCount = random_int(5, 30);
                for ($c = 0; $c < $commentCount; $c++) {
                    $commentAuthor = $users[random_int(0, $userCount - 1)];

                    $comment = new Comment();
                    $comment->setContent(sprintf(
                        'Commentaire %d sur le post de %s par %s',
                        $c + 1,
                        $author->getFirstName(),
                        $commentAuthor->getFirstName()
                    ));
                    $comment->setCreatedAt($now);
                    $comment->setAuthor($commentAuthor);
                    $comment->setPost($post);

                    $manager->persist($comment);
                }

                // Likes
                $likeCount = random_int(10, 50);
                for ($l = 0; $l < $likeCount; $l++) {
                    $likeUser = $users[random_int(0, $userCount - 1)];

                    $like = new Like();
                    $like->setUser($likeUser);
                    $like->setPost($post);

                    $manager->persist($like);
                }
            }
        }

        $manager->flush();
    }
}
