<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160804175916 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_experts");

        $this->addSql("CREATE TABLE nl_experts(
           id              int(11) AUTO_INCREMENT NOT NULL,
           name            varchar(200) DEFAULT NULL,
           description     longtext DEFAULT NULL,
           image_path      varchar(255) DEFAULT NULL,
           phone           varchar(100) DEFAULT NULL,
           email           varchar(255) DEFAULT NULL,
           address         varchar(500) DEFAULT NULL,
           city            varchar(100) DEFAULT NULL,
           country         varchar(100) DEFAULT NULL,
           expertise       varchar(255) DEFAULT NULL,
           created_at      datetime NOT NULL,
           deleted         tinyint(1) DEFAULT 0,
           relevent_exp    float(5, 2) DEFAULT 0.00,
           job_title       varchar(100) DEFAULT NULL,
           intro           text DEFAULT NULL,
           facebook        varchar(200) DEFAULT NULL,
           twitter         varchar(200) DEFAULT NULL,
           google          varchar(200) DEFAULT NULL,
           linkedin        varchar(200) DEFAULT NULL,
           twitter_feeds   longtext DEFAULT NULL,
           INDEX IDX_961E787YU5182D95 (name),
           INDEX IDX_9667YU56ERE87JK1 (email),
           INDEX IDX_961E78YU09GH7U95 (city),
           INDEX IDX_9TY56ER98UY87JK1 (country),
           INDEX IDX_9TUI78RT67GF7JK1 (expertise),
           PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

        $desc_ahmet = '[{"position":"Founder & CEO Zingat.com","headdesc":"smart real estate site in Turkey","timeline":"April 2015 – Present","year":"1 year 5 months","place":"Istanbul, Turkey","desc":"Mission: <span>Real Estate, Information, Trust</span>.</br>Zingat, which came into operation in 2015, by adopting the high quality services and transparent information, understanding, real estate professionals and individuals under the same roof, a real estate information and marketing platform that combines accurate and comprehensive reference information around.</br><span>Zingat</span> name, an enormous amount of information and expression that provide data service <span>zillion</span> z of the word (zillion many more) with Hungarian in the sale, in to Indonesian DATA and Filipince was formed by the merger of the incoming Ingate word meaning TRUST.</br>Zingat is an emphasis on work we do. Our goal is to invest in the real estate sector in Turkey, buying a home, renting, all our citizens a new house in the area and facing long-term in this sector and to create a reference to information from the professionals who made their living here in a professional manner.</br>Real estate investment is one of the most important financial decisions that can be given, and perhaps the most important people in their lives. Zingat individuals, the information they need when making this important decision, trust and service, aims to offer the most transparent way. There are very limited data and information about real estate in our country.</br>Zingat, as REIDIN focusing on the worlds only developing countries, the first and the largest real estate knowledge harbors for his cooperation and within the platform with professional analysis and editorial teams the most accurate and useful information is working to provide individuals and professionals.</br>Zingat individuals and by providing quality information and services they need and transparency of professional real estate platform aims to be the leader of Turkey."},{"position":"Founder & CEO REIDIN","headdesc":"Real Estate Information","timeline":"April 2006 – Present","year":"10 year 5 months","place":"Dubai, Istanbul","desc":"REIDIN is the worlds first Real Estate Information Company focusing mainly on Emerging Markets.</br>REIDIN saves property professionals resource, time and money by providing hard to get real estate data and information."},{"position":"Global Business Manager - IFIS","headdesc":"ISI Emerging Markets (Euromoney)","timeline":"January 2004 – April 2006","year":"2 years 4 months","place":"","desc":""},{"position":"Regional Manager - MENA","headdesc":"ISI Emerging Markets (Euromoney)","timeline":"May 2000 – April 2006","year":"6 years","place":"","desc":""}]';

        $feed_ahmet =  '<a class="twitter-timeline" data-height="500" data-theme="light" data-link-color="#e36159" href="https://twitter.com/AhmetKayhan">Tweets by AhmetKayhan</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';

        $this->addSql("INSERT INTO nl_experts(id,
                       name,
                       description,
                       image_path,
                       phone,
                       email,
                       address,
                       city,
                       country,
                       expertise,
                       created_at,
                       deleted,
                       relevent_exp,
                       job_title,
                       intro,
                       facebook,
                       twitter,
                       google,
                       linkedin,
                       twitter_feeds)
        VALUES (
                  1,
                  'Ahmet Kayhan',
                  '{$desc_ahmet}',
                  'ahmet_kayhan.jpg',
                  '04 277 6835',
                  'akayhan@reidin.com',
                  'Office no. 2304, Concord Tower, Dubai Media City',
                  'Dubai',
                  'UAE',
                  'Entrepreneurship, Venture Capital, Business Strategy, Investments, Management, Emerging Markets, Real Estate, Business Development, Start-ups, Business Planning, International Sales',
                  '2016-08-01 21:30:49.0',
                  FALSE,
                  16.0,
                  'Founder and CEO at REIDIN - Real Estate Information and ZINGAT - Real Estate Marketing Platform',
                  '- Founder and CEO of REIDIN (www.reidin.com) a B2B real estate data and information company focusing on emerging markets and </br>- Founder and CEO of Zingat.com - a B2C real estate information and marketing platform empowering individuals with real estate knowledge. <br>Areas of Interest: real estate, emerging markets, big data, M&A, private equity, venture capital, Galatasaray Sports Club, basketball...',
                  NULL,
                  '@AhmetKayhan',
                  NULL,
                  'https://ae.linkedin.com/in/ahmetkayhan',
                  '{$feed_ahmet}')");

        $desc_jerry = '[{"position":"Partner","headdesc":"Law Firm Taylor Wessing","timeline":"March 1997 – Present","year":"19 years 6 months","place":"Dubai","desc":""},{"position":"Solicitor","headdesc":"Nabarro LLP","timeline":"1991 – 1996","year":"5 years","place": "London, United Kingdom","desc": "Property litigation lawyer."}]';

        $feed_jerry =  '<a class="twitter-timeline" data-height="500" data-link-color="#e36159" href="https://twitter.com/JerryParks14">Tweets by JerryParks14</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';

        $this->addSql("INSERT INTO nl_experts(id,
                       name,
                       description,
                       image_path,
                       phone,
                       email,
                       address,
                       city,
                       country,
                       expertise,
                       created_at,
                       deleted,
                       relevent_exp,
                       job_title,
                       intro,
                       facebook,
                       twitter,
                       google,
                       linkedin,
                       twitter_feeds)
        VALUES (
                  
                  2,
                  'Jerry Parks',
                  '{$desc_jerry}',
                  'jerry_parks.jpg',
                  '04 309 1000',
                  'j.parks@taylorwessing.com',
                  '26th Floor, Rolex Tower, Sheikh Zayed Road, PO Box 33675, Dubai, United Arab Emirates',
                  'Dubai',
                  'UAE',
                  'Real Estate, Commercial Litigation, Property Law, Legal Advice, Corporate Law, Real Estate, Dispute Resolution, Corporate Governance, Legal Issues, Arbitration, Litigation',
                  '2016-08-01 21:34:06.0',
                  FALSE,
                  8.0,
                  'Partner',
                  'Jerry is a UK qualified solicitor.  He came to Dubai in 1997, since which time he has advised on a variety of matters including company, commercial, employment, litigation, arbitration, succession and real estate. He now heads the Taylor Wessing Real Estate and Private Client teams, based in Dubai. ',
                  NULL,
                  '@JerryParks14',
                  NULL,
                  'https://ae.linkedin.com/in/jerry-parks-10a8b11b',
                  '{feed_jerry}')");

        $desc_alw= '[[{"position":"CEO Harbor Real Estate","headdesc":"An Award-Winning Integrated Real Estate Service Provider","timeline":"December 2007 – Present","year":"8 years 9 months","place":"Dubai, United Arab Emirates","desc":""},{"position":"Content Producer & Presenter of MEMAAR on Dubai TV & Sama Dubai TV Dubai Media Incorporated","headdesc":"Dubai Channels Network (Dubai TV & Sama Dubai TV)","timeline":"February 2015 – Present","year":"1 year 7 months","place":"Dubai","desc":"<span>MEMAAR</span> <span>برنامج معمار</span> is the first-of-its-kind reality TV property show in the Middle East that delivers a fresh in-house concept and exciting production from Dubai TV... The show is dedicated to promoting the dynamic Real Estate sector in Dubai and cementing Dubai’s vision and efforts towards hosting the best ever World Expo in 2020.</br><span>MEMAAR</span> follows celebrities and top achievers through their journey to find their new luxury property in Dubai.</br><span>MEMAAR</span> will help position Dubai as the center of attraction, as the City’s high-end properties, infrastructure and facilities continue to wow residents and attract investors, businesses and tourists from all across the globe.<br>To view all the episodes of <span>MEMAAR</span> online, please visit: <a href="http://www.dcndigital.ae/#/show/205329/0/0/رامعم">Link</a><br>"},{"position":"Instructor & Faculty Advisory Board Member Dubai Real Estate Institute (DREI)","headdesc":"The official certification arm of the Dubai Land Department","timeline":"October 2008 – Present","year":"7 years 11 months","place":"Dubai, United Arab Emirates","desc":"Author & Instructor of the following professional training programs:<br>- Certified Property Manager (The official Certification course for all property management professionals in Dubai and Sharjah)<br>- Roadmap to Customer Advocacy (The ultimate Real Estate customer service training)<br>- Negotiation Skills for Real Estate Professionals<br>- Effective Communication Skills for Real Estate Professionals"},{"position":"Marketing & Sales Director Sama Dubai","headdesc":"The Global Real Estate Arm of Dubai Holding","timeline":"February 2006 – December 2007","year":"1 year 11 months","place":"Dubai, United Arab Emirates","desc":""},{"position":"Regional Account Director","headdesc":"Leo Burnett Group","timeline":"May 1999 – February 2006","year":"6 years 10 months","place":"Dubai, United Arab Emirates","desc":""},{"position":"Marketing Executive","headdesc":"Emirates Petroleum Products Company (EPPCO)","timeline":"April 1998 – May 1999","year":"1 year 2 months","place":"Dubai, United Arab Emirates","desc":""}]';

        $feed_alw =  '<a class="twitter-timeline" data-height="500" data-link-color="#e36159" href="https://twitter.com/mohanadalwadiya">Tweets by mohanadalwadiya</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';

        $this->addSql("INSERT INTO nl_experts(id,
                       name,
                       description,
                       image_path,
                       phone,
                       email,
                       address,
                       city,
                       country,
                       expertise,
                       created_at,
                       deleted,
                       relevent_exp,
                       job_title,
                       intro,
                       facebook,
                       twitter,
                       google,
                       linkedin,
                       twitter_feeds)
        VALUES (
                  3,
                  'Mohanad Alwadiya',
                  '{$desc_alw}',
                  'Mohanad_Alwadiya.jpg',
                  '04 325 1616',
                  'info@harbordubai.com',
                  '18th Floor, City Tower 2, Sh. Zayed Road',
                  'Dubai',
                  'UAE',
                  'Real Estate Investment / Property Asset Management / Research, Valuation & Advisory / Marketing, Sales, Rental / CRM, Handover & Project Management / Snagging & Inspection',
                  '2016-08-04 19:02:47.0',
                  FALSE,
                  18.0,
                  'CEO at Harbor Real Estate',
                  'Dubbed “The Wolf of Real Estate” in the April 2014 edition of Property Times, Mohanad Alwadiya was also the front cover subject of SME Advisor Arabia’s February 2016 issue, and of the front cover exposé as “The Godfather of Property Management” in the February 2015 issue of Gulf Property. Considered to be the real estate industry’s most dynamic practitioner, Mohanad is an award-winning real estate entrepreneur and prominent industry influencer.',
                  'https://www.facebook.com/mohanadalwadiya/',
                  '@mohanadalwadiya',
                  NULL,
                  'https://ae.linkedin.com/in/mohanadalwadiya',
                  '{$feed_alw}')");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE nl_experts");

        $this->addSql("CREATE TABLE `nl_experts` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `description` longtext COLLATE utf8_unicode_ci NOT NULL,
          `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `expertise` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `created_at` datetime NOT NULL,
          `deleted` tinyint(1) NOT NULL,
          `relevent_exp` float(5,2) DEFAULT '0.00',
          `job_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
          `intro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
          `facebook` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
          `twitter` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
          `google` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
          `linkedin` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

    }
}
