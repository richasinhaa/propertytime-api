<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 *Neighbourhood descriptions
 */
class Version20160522145835 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $desc1 = 'Jumeirah Lake Tower is a widespread neighborhood formulated by DMCC, it is constructedamid theboundaries of three unnatural lakes. The integratedassociation was developed with well-poisedresidential and non-residential factors. The brilliant network JLT Metro Station and outstanding town planning ensuresamazing connectivity in this community. JLT is an appealing choose for corporate sectors and there is a huge demand for putting up in this area since it is a free zone. The blueprint of DMCC endows maximum units to featurekeeneyeshotof one of the two either the lakes or that of Jumeirah Island.';

        $this->addSql("update nl_neighbourhood set description =  '{$desc1}' where name like '%Jumeirah Lakes Towers%'");

        $desc2 = 'For long now, people have felt the need for affordable housing in Dubai. Homes that offer a decent lifestyle without burning a hole in the pocket. This has brought Remraam to focus. Now Remraam is a residential development by Dubai Properties Group (DPG). There are a number of factors that have made Remraam popular among the buyers, investors and tenants.

            Remraam is an affordable residential community. It has all the necessary facilities and amenities to meet the day-to-day needs and requirements of its residents. The community has 24/7 security and offers a tranquil lifestyle amid lush green surroundings. The accessibility is improving at a rapid pace. With future improvisations in the infrastructures, access will get even better. Even now, it takes only about 15 minutes to reach Al Maktoum International Airport from Remraam. The development is also located close to World Expo 2020 venue, which might have positive significances in the future.

            Anticipating the need of the market, Dubai Properties Group came up with Remraam, way back in 2007. The original master plan had four phases with a central shopping mall. Phase I with about 2,700 units was launched in 2007, while the Phase II with about 1,200 apartments was launched in 2008. With financial crisis hitting the market towards the end of 2008, plans for phases III and IV and the shopping mall couldn’t take off. The crisis took a toll on the launched projects and delayed delivery dates.

            However, the project began picking up again in 2012. Slowly but steadily, homeowners and tenants started to trickle in. Property prices and rents, which had significantly depreciated, started to pick up. With rent enhancements and increasing ROIs, more investors began to show their interest. With demand heightening, the developers quickened efforts to tie the few loose ends. The development started to wear a green look and amenities got completed rapidly.

            The project was planned and developed with an intention to provide peaceful family living. With nationalities from world over currently staying in the community, it now has a very diverse and vibrant fervour. As a natural consequence of the financial crisis, that had beset the project, a number of investors and buyers had suffered loss. But those who stuck around were rewarded as the units have undergone appreciation in prices.

            The future for Remraam looks bright and positive, despite occasional fluctuations in prices. It is located near the World Expo 2020 venue and is close to the new Al Maktoum International Airport, which when complete would become the world’s biggest airport. Demands in the area is high and is bound to go further north as we inch towards the Expo 2020.';

        $this->addSql("update nl_neighbourhood set description = '{$desc2}' where name like '%Remraam%'");

        $desc3 = 'The Dubai Financial Center, normally known as DIFC is the federal financial district of Dubai, it follows metropolises like New York, Hong Kong and London. The DIFC has a separate strategy for foreign investments in this area. There are incredible residential choices offered by DIFC around the icons Burj Khalifa and Dubai Mall. Close to the area there are enormous entertainment benefits presented by the Business district of Dubai. DIFC is the best choice for energy and excitement buffs of the metropolis area which is surrounded by premier hotels like Ritz Carlton, Shangri La and Warwick.';
        $this->addSql("update nl_neighbourhood set description = '{$desc3}'where name like '%DIFC%'");

        $desc4 = 'Build along the lines of Canary Wharf in London’s Docklands, Business Bay has been conceptualised as Dubai’s Central Business District. The project features a numerous high-rises that include the majestic Ubora, Churchill and Executive Towers. Overlooking the iconic Burj Khalifa, Business Bay comprises of a commercial, residential and business cluster along the Dubai Creek extension.

            Spread over an area of 43 sq. km, Business is a community that offers its residences a unique experience of corporate life with a twist of world’s famous Dubai glamour. Often hailes as ‘a city within a city’, Business Bay boasts of exceptional connectivity to all major roads. The Dubai International Airport is barely 15-20 minutes drive from the Business Bay, while the nearest metro station and the city center are barely 10 minutes away.

            To take care of your everyday needs and desires, there are more than 100 retail outlets in the community.';

        $this->addSql("update nl_neighbourhood set description ='{$desc4}' where name like '%Business Bay%'");

        $desc5 = 'Real Estate Fanatics have an impressive report about Victory Heights. Proclaimed as one of the leading villa communities of interests in Dubai, the growth has seen a drop in prices in the bygone year in spite of rising requirements and inadequate supply. Although there is a persisting boost in the rents, resisting the market vogues on the whole. At present, Victory Heights seems to be poised between demand and supply,” says Ahmet Kayhan, CEO, REIDIN, also he adds “There is a rise in demand because of short supply pipeline of only about 30 units under construction to be presented by the end of 2015.” Ahmet states from the peak in 2014, Victory Heights encountered an emphatic dip in costs on account of impractical hike and immense sizing. “The present improvisation is in the ambit as costs arose up above 2008 at its peak levels last year,” he also adds, “On the other aspect, the rental market has seen a boost. Victory Heights can be regarded as appropriate when it comes to gross rental yield as equated to other areas.”';

        $this->addSql("update nl_neighbourhood set description = '{$desc5}' where name like '%Victory Heights%'");

        $desc6 = 'Emaar properties is the key developer of Dubai Marina, the essence of new Dubai. Dubai Marina is a 3km extensive base drawing in both visitors and investors equally. It is an amazing neighborhood to dwell with easy access topublic transport facility. Dubai Marina is one such over-the-top places with superior views, encompassing shopping and dining choices that makes it a must visit spot. Since Dubai Marina is close to areas like JLT, Dubai Media City and Dubai Internet City, it works out to be a suitable place for occupants who desire to live close to their workplace.';

        $this->addSql("update nl_neighbourhood set description = '{$desc6}' where name like'%Dubai Marina%'");

        $desc7 = 'At present the stunning tourist attraction ‘Palm Jumeirah’ is a key signature creation by Dubai’s superior developer Nakheel. The call for the properties on the Palm has constantly been on the high gear. The most prominent man-made island of the world has appealed thousands of tourists and capitalists worldwide ever since it was set in motion in 2001. Buying a portion of Palm Jumeirah is a way to represent a high social and economic standforthe rich and the renowned. The artificial island has a 2-kilometer long-sighted trunk and 17 fronds that makes up its crown besides the crescent, that forms a semblance of a palm tree.”';

        $this->addSql("update nl_neighbourhood set description = '{$desc7}' where name like'%Palm Jumeirah%'");

        $desc8 = 'Nestled in an artificial lake, this offering from premium developers, Nakheel Properties, has managed to retain a warm spot in the hearts of investors, end users and tenants alike. What helps its cause further is its strategic location, which combines with its urban design to elevate the Jumeirah Islands to one of the top villa communities in Dubai.

            Over the past couple of years, Jumeirah Islands have registered substantial growth in terms of sales price and rental appreciation. In the villa segment, it has maintained its stature as one of the chief investment destinations. Its affluent features and amenities have ensured that families keep flocking the villas in these islands.

             

            Location, location & location!

            Jumeirah Islands is one of the best located housing developments of Dubai. The clusters within are well set and elegantly designed. It is conveniently located just east of the Sheikh Zayed Road, and in the form of Jumeirah Lake Towers and Emirates Hills, the development has several prestigious neighbours. There are 50 islands in total, that boasts of 736 villas, each of which features a private swimming pool.

             

            Prices and Rents in the Jumeirah Islands

            In the past few years, villa prices in Jumeirah Islands have increased by a margin, which is slightly higher than the Dubai villa market. The appreciation in the rental prices have been in line with Dubai general villa prices.

            As we write, more houses and shops are being readied at Jumeirah Islands. With a location this beautiful, the news of more developments in and around the area, do not come as a surprise.';

        $this->addSql("update nl_neighbourhood set description = '{$desc8}' where name like '%Jumeirah Islands%'");

        $desc9 = 'Built around the edge of three artificial lakes (Lake Almas West, Lake Almas East and JLT Lake), Jumeirah lake Towers is an extensive community. Developed by Dubai Multi Commodities Centre (DMCC), it has a striking presence in Dubai’s landscape.
            <>The community boasts of a good balance of commercial and residential elements. Special emphasis has been placed on comfort and luxury. And the homes have been designed to offer excellent views on all sides.

            To serve the distinguished residents of JLT, there are more than 100 retail outlets that house restaurants, supermarkets and chic fashion brands. Within a 10-minute walking distance, the residents have access to a 55,000 square metre park, that comes with a jogging track and soon will feature a amphitheater, besides other sports facilities. In addition, there are several hotels and schools in the vicinity.

            To facilitate connectivity, there is the JLT Metro Station, which is within a distance that can be comfortably walked in 5-10 minutes. The airport isn’t far and the city center, too, is nearby. 
            Currency occupancy, at JLT, is over 90%.';

         $this->addSql("update nl_neighbourhood set description = '{$desc9}' where name like'%Jumeirah Lakes Towers%'");

        $desc10 = 'The Villa Project is a luxury residential villa community located in Dubailand. The project takes inspiration from the Spanish-style country housing. It comprises of 1,811 elegantly designed, luxury villas with 4, 5 and 6 bedroom options; and plots, for those of you who would want to work their own architectural magic.

            The Villa Project is ideal for those who seek to nestle in the comfort of tranquil homes, away from the hustle and bustle, and yet remain close to the city centre. The villas here are spacious and feature state-of-the-art modern amenities.

            With views of the mystical desert landscape, it is a self-contained, gated community with excellent connectivity. Developed in collaboration by Dubai Properties and Mazaya, the project offers wide range of properties to choose from. The entire development is divided into four clusters – The Haciendas, The Ponderosa, The Aldea and The Centro.Each of these clusters are special in their own right.

            While The Haciendas come with exclusive villas in manicured gardens, The Ponderosa offers ranch style villas with private courtyards. Not to be left behind, The Aldea presents handsomely planned courtyard living. The Centro, with its cafes, restaurants and shopping arcades is the community centre.';

         $this->addSql("update nl_neighbourhood set description = '{$desc10}' where name like '%The Villa%'");

         $desc11 = 'A Humble Beginning
                    Compare Dubai to what it was a few decades ago and what it is now, and notice the drastic changes that this city has undergone. What once had been a humble settlement is now home to some of the most iconic buildings in the world that offers innumerable lifestyle choices to its privileged residents, making life in Dubai truly inspiring.
                    The Rise of a New City
                    Touted often as a playground for the rich, Dubai has earned its rightful spot in the league of extraordinary cities. Unlike many other Gulf powers, Dubai did not build its destiny on the strength of oil. Surely, oil did help its cause initially, however it was pure human ambition that has enabled Dubai to script its own modern tale. The economic fate of this metropolis is currently being propelled by tourism, aviation, financial services and real estate.
                    Over the years, Dubai has come to symbolize a hard-nosed attitude and a futuristic vision. This is evident in its breath-taking towers that pierce the clouds and dwarf the skies. If Burj Khalifa has surpassed vertical limits, its indoor ski resort has brought winter to the desert. And its man-made islands, they simply are an awe-inspiring engineering feat.
                    Redefining Grandness
                    The air in Dubai is suffused with luxury and opulence. You only need to open your eyes and see, to soak in the profusion that is Dubai. If life in Dubai is fast, the cars are faster, the yachts bigger, and the homes larger. Perhaps that is why it won’t come as a surprise that the world’s only seven star hotel is in Dubai – the Burj Al Arab.
                    To top this Dubai has the biggest shopping mall in the world, which offers a number of brands and product choices. It also boasts of the world’s busiest airport (by International passenger traffic).
                    Everything in Dubai has to be grand, made of gold and studded with diamonds. After all, even the police here drives Aston Martins and Ferraris. Still, if you need further proof of its lavishness, know this that there are ATMs in Dubai that dispense gold bars.
                    Life in Dubai is a Seamless Union of Tradition and Modernity
                    Despite all its lush display of lavishness, life in Dubai is deeply rooted in tradition. It has flawlessly merged its rich heritage with its contemporary ambitions to make Dubai one of the most liberal places in the region. No wonder why nationals from more than 200 countries stay and work in Dubai, making it truly cosmopolitan. In fact, Emiratis (as the locals are called) form only 15% of the population.
                    Perhaps the one fact that makes Dubai most appealing to expats is its tax free regime. This couples with its low crime rate to make Dubai an ideal location for people from anywhere to settle in.
                    Dubai did suffer a slump in the aftermath of the 2008 American real estate crisis in 2009. The market, however, has since rejuvenated with a renewed hope. The aura of Dubai is filled with energy, excitement and optimism that brings the best out of you. And with World Expo 2020 approaching, we wonder what more Dubai will have in store for us.
                    Come live your dream in Dubai.';

         $this->addSql("update nl_neighbourhood set description = '{$desc11}' where name like '%Dubai%'");

         $this->addSql("insert into nl_neighbourhood_metrics(neighbourhood_name, neighbourhood_id, avg_sales_price, avg_rental_value, maintenance_fee, annual_gross_yield, occupancy) values ('Jumeirah Lakes Towers', 202, 1228, 8.5, 14.5, 8.3, 89.08)");

         $this->addSql("insert into nl_neighbourhood_metrics(neighbourhood_name, neighbourhood_id, avg_sales_price, avg_rental_value, maintenance_fee, annual_gross_yield, occupancy) values ('Jumeirah Islands', 201, 0.0, 0.0, 0.0, 0.0, 0.0)");

         $this->addSql("insert into nl_neighbourhood_metrics(neighbourhood_name, neighbourhood_id, avg_sales_price, avg_rental_value, maintenance_fee, annual_gross_yield, occupancy) values ('Remraam', 269, 0.0, 0.0, 0.0, 0.0, 0.0)");

         $this->addSql("insert into nl_neighbourhood_metrics(neighbourhood_name, neighbourhood_id, avg_sales_price, avg_rental_value, maintenance_fee, annual_gross_yield, occupancy) values ('The Villa', 297, 0.0, 0.0, 0.0, 0.0, 0.0)");

         $this->addSql("insert into nl_neighbourhood_metrics(neighbourhood_name, neighbourhood_id, avg_sales_price, avg_rental_value, maintenance_fee, annual_gross_yield, occupancy) values ('Victory Heights', 309, 0.0, 0.0, 0.0, 0.0, 0.0)");

         $this->addSql("insert into nl_neighbourhood_metrics(neighbourhood_name, avg_sales_price, avg_rental_value, maintenance_fee, annual_gross_yield, occupancy) values ('Dubai', 1367, 8.5, 15.6, 7.8, 88.4 )");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("update nl_neighbourhood set description = NULL");
        $this->addSql("delete from nl_neighbourhood_metrics where neighbourhood_id in (202, 201, 269, 297, 309)");
        $this->addSql("delete from nl_neighbourhood_metrics where neighbourhood_name like '%Dubai%'");

    }
}
