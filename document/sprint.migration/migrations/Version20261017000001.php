<?php

namespace Sprint\Migration;

class Version20261017000001 extends Version
{
    protected $description = "Создание инфоблоков для сайта Dianomi с контентом";

    /**
     * @throws \Sprint\Migration\Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        // Создаём тип инфоблоков "Services"
        $helper->Iblock()->saveIblockType([
            'ID' => 'services',
            'LANG' => [
                'ru' => [
                    'NAME' => 'Услуги',
                    'SECTION_NAME' => 'Разделы услуг',
                    'ELEMENT_NAME' => 'Элементы услуг',
                ],
                'en' => [
                    'NAME' => 'Services',
                    'SECTION_NAME' => 'Service sections',
                    'ELEMENT_NAME' => 'Service elements',
                ],
            ],
        ]);

        // Создаём инфоблок "Услуги"
        $iblockId = $helper->Iblock()->saveIblock([
            'NAME' => 'Услуги',
            'CODE' => 'services',
            'SOCNET_GROUP_ID' => 0,
            'IBLOCK_TYPE_ID' => 'services',
            'LID' => ['s1'],
            'LIST_PAGE_URL' => '#SITE_DIR#/services/',
            'DETAIL_PAGE_URL' => '#SITE_DIR#/services/#SECTION_ID#/#ELEMENT_ID#',
            'SECTION_PAGE_URL' => '#SITE_DIR#/services/#SECTION_ID#/',
            'PROPERTY_INDEX' => ['NAME', 'CODE'],
        ]);

        // Поля инфоблока
        $helper->Iblock()->saveIblockFields($iblockId, [
            'NAME' => [
                'DEFAULT_VALUE' => [],
            ],
            'CODE' => [
                'DEFAULT_VALUE' => [
                    'TRANSLITERATION' => 'Y',
                    'UNIQUE' => 'Y',
                ],
            ],
            'PREVIEW_TEXT' => [],
            'DETAIL_TEXT' => [],
            'PREVIEW_PICTURE' => [],
            'DETAIL_PICTURE' => [],
        ]);

        // Пользовательские свойства
        $helper->Iblock()->saveProperty($iblockId, [
            'NAME' => 'Цена',
            'CODE' => 'PRICE',
            'PROPERTY_TYPE' => 'string',
        ]);

        $helper->Iblock()->saveProperty($iblockId, [
            'NAME' => 'Иконка',
            'CODE' => 'ICON',
            'PROPERTY_TYPE' => 'string',
        ]);

        // Создаём инфоблок "FAQ"
        $faqIblockId = $helper->Iblock()->saveIblock([
            'NAME' => 'FAQ',
            'CODE' => 'faq',
            'SOCNET_GROUP_ID' => 0,
            'IBLOCK_TYPE_ID' => 'services',
            'LID' => ['s1'],
            'LIST_PAGE_URL' => '#SITE_DIR#/faq/',
            'DETAIL_PAGE_URL' => '#SITE_DIR#/faq/#ELEMENT_ID#',
            'PROPERTY_INDEX' => ['NAME', 'CODE'],
        ]);

        $helper->Iblock()->saveIblockFields($faqIblockId, [
            'NAME' => [],
            'CODE' => [
                'DEFAULT_VALUE' => [
                    'TRANSLITERATION' => 'Y',
                    'UNIQUE' => 'Y',
                ],
            ],
            'PREVIEW_TEXT' => [],
            'DETAIL_TEXT' => [],
        ]);

        // Добавляем элементы FAQ
        $helper->Iblock()->addElement($faqIblockId, [
            'NAME' => 'Что такое 1С-Битрикс?',
            'PREVIEW_TEXT' => '1С-Битрикс — популярная CMS для создания корпоративных порталов и интернет-магазинов.',
            'DETAIL_TEXT' => '1С-Битрикс — это универсальная платформа для создания сайтов любого масштаба. Она включает встроенные инструменты для SEO-оптимизации, интеграции с 1С, CRM-системы и многое другое.',
            'PREVIEW_TEXT_TYPE' => 'text',
            'DETAIL_TEXT_TYPE' => 'text',
            'ACTIVE' => 'Y',
        ]);

        $helper->Iblock()->addElement($faqIblockId, [
            'NAME' => 'Сколько стоит внедрение Битрикс24?',
            'PREVIEW_TEXT' => 'Стоимость зависит от масштаба проекта и требуемого функционала.',
            'DETAIL_TEXT' => 'Мы предлагаем индивидуальные решения для каждого клиента. Стоимость начинается от 100 000 рублей для базового внедрения и может увеличиваться в зависимости от сложности проекта.',
            'PREVIEW_TEXT_TYPE' => 'text',
            'DETAIL_TEXT_TYPE' => 'text',
            'ACTIVE' => 'Y',
        ]);

        $helper->Iblock()->addElement($faqIblockId, [
            'NAME' => 'Какие сроки внедрения?',
            'PREVIEW_TEXT' => 'Сроки зависят от сложности проекта и обычно составляют от 2 до 8 недель.',
            'DETAIL_TEXT' => 'Базовое внедрение занимает 2-3 недели. Более сложные проекты с кастомными интеграциями могут занять до 2-3 месяцев.',
            'PREVIEW_TEXT_TYPE' => 'text',
            'DETAIL_TEXT_TYPE' => 'text',
            'ACTIVE' => 'Y',
        ]);

        // Создаём инфоблок "Решения"
        $solutionsIblockId = $helper->Iblock()->saveIblock([
            'NAME' => 'Решения',
            'CODE' => 'solutions',
            'SOCNET_GROUP_ID' => 0,
            'IBLOCK_TYPE_ID' => 'services',
            'LID' => ['s1'],
            'LIST_PAGE_URL' => '#SITE_DIR#/solutions/',
            'DETAIL_PAGE_URL' => '#SITE_DIR#/solutions/#ELEMENT_ID#',
            'PROPERTY_INDEX' => ['NAME', 'CODE'],
        ]);

        $helper->Iblock()->saveIblockFields($solutionsIblockId, [
            'NAME' => [],
            'CODE' => [
                'DEFAULT_VALUE' => [
                    'TRANSLITERATION' => 'Y',
                    'UNIQUE' => 'Y',
                ],
            ],
            'PREVIEW_TEXT' => [],
            'DETAIL_TEXT' => [],
            'PREVIEW_PICTURE' => [],
            'DETAIL_PICTURE' => [],
        ]);

        $helper->Iblock()->saveProperty($solutionsIblockId, [
            'NAME' => 'Преимущества',
            'CODE' => 'ADVANTAGES',
            'PROPERTY_TYPE' => 'string',
        ]);

        $helper->Iblock()->saveProperty($solutionsIblockId, [
            'NAME' => 'Иконка',
            'CODE' => 'ICON',
            'PROPERTY_TYPE' => 'string',
        ]);

        $this->outSuccess('Инфоблоки созданы успешно');
    }

    /**
     * @throws \Sprint\Migration\Exceptions\HelperException
     * @return bool|void
     */
    public function down()
    {
        $helper = $this->getHelperManager();
        
        $ok1 = $helper->Iblock()->deleteIblockIfExists('services');
        $ok2 = $helper->Iblock()->deleteIblockIfExists('faq');
        $ok3 = $helper->Iblock()->deleteIblockIfExists('solutions');

        if ($ok1 && $ok2 && $ok3) {
            $this->outSuccess('Инфоблоки удалены');
        } else {
            $this->outError('Ошибка удаления инфоблоков');
        }
    }
}
