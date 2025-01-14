<?php

namespace App\Form;

use App\Entity\Test;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Test $test */
        $test = $options['data'];

        foreach ($test->getQuestions() as $index => $question) {
            $questionNumber = $index + 1;

            $builder->add("question_{$question->getId()}", QuestionFormType::class, [
                'data' => $question,
                'label' => $question->getDescription(),
                'mapped' => false,
                'block_name' => 'question',
                'number' => $questionNumber,
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
        ]);
    }
}
