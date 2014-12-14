BisonLabProductMasterBundle
===========================

A Product master. Basically an extended product catalog with campaigns, prices and owner / ledger account information.


This is very much a work in progress. It was conceived as a SYmfony 2.0.3 project an evening I got a product list as an Excel spread sheet. I converted it into a product catalog (This one) that evening.

It has had one stint of work since then, to make it Symfony 2.3 compatible.

Now I have changed the name to reflect the new company and it also has it's first post on Github as an available project. If this looks interesting, pester me and I'll continue developing it sooner rather than when I need it myself.

If you look at the code it does not really look like the typical Doctrine layout in Entity. This is because I was experimenting with separating Doctrine Entity specific stuff and the Model object itself. This *is* a good idea, but I have been too lazy to keep doing this since.

Components
==========

 * Catalogs  
 * Products
 * Campaign (Like "Three first months free", "Free installation" and so on.)
 * Owners (Both for knowing who is resopnsible and divide cost/revenue)
 * Accounts (For cost and revenue. Be careful and try not to end up here..)
 
A catalog can have one or more products.
A product can have one or more owners.
A Campaign can be tied to one ore more Products.
A product can have none or many accounts of either cost and revenue. (But please, if possible you should use your accointing/ledger for this functionality).

TODO
====

* Implementing the CommonBundle into this. Especially the context system, since it's one of the main reasons of a product master to keep track of how/where/what in the different systems having products. Storing system, object name and external ID here will make it possible to send and retrieve data from each system having products.
