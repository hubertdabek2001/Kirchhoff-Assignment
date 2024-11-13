Baza MS SQL
Instancja Hydms8
baza Hydra1


serwer: miesrv915.mes.kautomotive.local
użytkownik: plan_user
hasło:GyFAZn5m


select 
h.subkey1 as machine
,ab.artikel as KA
,h.gut_pri
,getdate() as durrent_time
,h.anmeld_dat+DATEADD(s, h.anmeld_zeit-h.dauer, 0) as planned_start_time
,h.anmeld_dat+DATEADD(s, h.anmeld_zeit, 0) as logon_time
,h.anmeld_dat+DATEADD(s, h.anmeld_zeit+h.dauer, 0) as planned_end_time


from 
hydadm.hybuch h
left join hydadm.maschinen m on h.subkey1=m.masch_nr
left join hydadm.auftrags_bestand ab on h.subkey2=ab.auftrag_nr
where 
key_type='A'
and ab.auftrag_art='0'
and m.mgruppe='PAUT'



select * from prod_plan

id	masch_nr	auftrag_nr				KA				target_time	target_quantity
1	P-19	137764001702411000010010	13776.40.017.02	5512		4070
2	P-19	141024000302411099910010	14102.40.003.02	3058		3899
3	P-19	141024000401411099910010	14102.40.004.01	3059		3899
4	P-19	157314000704411000010010	15731.40.007.04	6329		5106
5	P-19	116624000306411000010010	11662.40.003.06	12323		8156
6	P-19	121814003005411000010010	12181.40.030.05	13207		5380
7	P-19	128824000505411000010010	12882.40.005.05	7405		4029
8	P-19	146934004404411099910010	14693.40.044.04	4544		4952
9	P-19	146934004504411099910010	14693.40.045.04	4544		4952
10	P-19	157314001803411000010010	15731.40.018.03	3645		2424