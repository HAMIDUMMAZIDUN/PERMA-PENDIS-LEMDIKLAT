<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $raw = <<<'EOD'
1	PPI. 1923.02.0001	Prof. Dr. H. Badrudin, M.Ag., CIIQA, CEAM	UIN Sunan Gunung Djati Bandung
2	PPI. 1923.02.0002	Dr. H. Abdullah Aminuddin Aziz, M.Pd.I	Universitas Hasyim Asy'ari
3	PPI. 1923.02.0003	Dr. Isti’anah Abubakar, M.Ag. (alm)	UIN Maulana Malik Ibrahim Malang
4	PPI. 1923.02.0004	Dr (Hc). Ir. KH. Salahuddin Wahid (alm)	Universitas Hasyim Asy'ari
5	PPI. 1923.02.0005	Prof. Dr. H. Mahmud, M.SI	UIN Sunan Gunung Djati Bandung
6	PPI. 1923.02.0006	Prof. Dr. Amany Lubis, MA.	UIN Syarif Hidayatullah Jakarta
7	PPI. 1923.02.0007	Prof. Dr. H. Baharuddin, M.Pd.I.	UIN Maulana Malik Ibrahim Malang
8	PPI. 1923.02.0008	Prof. Dr. H. Salfen Hasri, M.Pd.	UIN Sultan Syarif Kasim Riau
9	PPI. 1923.02.0009	Prof. Dr. Raihani, M.Ed., Ph.D	UIN Sultan Syarif Kasim Riau
10	PPI. 1923.02.0010	Prof. Dr. H. Fatah Syukur, M.Pd.	UIN Walisongo Semarang
11	PPI. 1923.02.0011	Prof. Dr. Hj. Nur Uhbiyati, M.Pd.	UIN Walisongo Semarang
12	PPI. 1923.02.0012	Prof. Dr. Syafaruddin Siahaan, M.Pd. (alm)	UIN Sumatera Utara
13	PPI. 1923.02.0013	Prof. Dr. H. Fachruddin, MA.	UIN Sumatera Utara
14	PPI. 1923.02.0014	Prof. Dr. Darwyan Syah, M.Si., Ph.D (alm)	UIN Sultan Maulana Hasanuddin Banten
15	PPI. 1923.02.0015	Prof. Dr. Jamaluddin, M.Ed.	UIN Ar-Raniry Aceh
16	PPI. 1923.02.0016	Prof. Dr. H. Moh. Khusnuridlo, M.Pd.	UIN KHAS Jember
17	PPI. 1923.02.0017	Prof. Dr. H. Musthofa, M.Ag.	UIN Walisongo Semarang
18	PPI. 1923.02.0018	Dr. Sri Rahmi, MA.	UIN Ar-Raniry Aceh
19	PPI. 1923.02.0019	Dr. Mulyono, MA.	UIN Maulana Malik Ibrahim Malang
20	PPI. 1923.02.0020	Dr. Arifuddin Siraj, M.Ag.	UIN Alauddin Makassar
21	PPI. 1923.02.0021	Prof. Dr. H. Candra Widjaya, M.Pd.	UIN Sumatera Utara Medan
22	PPI. 1923.02.0022	Prof. Dr. Imam Machalli, M.Pd.	UIN Sunan Kalijaga Yogyakarta
23	PPI. 1923.02.0023	Prof. Dr. Hj. Siti Patimah, M.Pd.	UIN Raden Intan Lampung
24	PPI. 1923.02.0024	Dr. Hj. Syamsudduha, M.Pd.	UIN Alauddin Makasar
25	PPI. 1923.02.0025	Dr. Feiby Ismail, M.Pd.	IAIN Manado
26	PPI. 1923.02.0026	Dr. H. Muhammad Amar Khana, M.M.Pd.	UIN Sunan Gunung Djati Bandung
27	PPI. 1923.02.0027	Dr. H. Muhammad Rifa’i, M.Pd.	UIN Sumatera Utara
28	PPI. 1923.02.0028	Prof. Dr. Hj. Siti Rodliyah, M.Pd.	UIN KHAS Jember
29	PPI. 1923.02.0029	Dr. Samrin, M.Pd.	IAIN Kendari
30	PPI. 1923.02.0030	Dr. Imam Mawardi, M.Ag.	Universitas Muhammadiyah Magelang
31	PPI. 1923.02.0031	Prof. Dr. Ermis Suryana, S.Ag., M.Pd.I	UIN Raden Fatah Palembang
32	PPI. 1923.02.0032	Dr. Ambar Sri Lestari, SE., M.Pd.	UIN Sunan Gunung Djati Bandung
33	PPI. 1923.02.0033	Prof. Dr. Zainal Arifin, S.Pd.I., M.S.I.	UIN Sunan Kalijaga Yogyakarta
34	PPI. 1923.02.0034	Dr. Edi Saputra, M.Hum.	UIN Sumatra Utara Medan
35	PPI. 1923.02.0035	Dr. Syamsuddin, M.Pd.	IAIN Kendari
36	PPI. 1923.02.0036	Hary Nurhidayat, M.Pd.I	STAI Al-Ma’arif Way Kanan Lampung
37	PPI. 1923.02.0037	Muhammad Ripin Ikwandi, M.Pd.I.	STAI An-Najah Indonesia Mandiri
38	PPI. 1923.02.0038	Prof. Dr. Muhammad Thoyib, M.Pd.	IAIN Ponorogo
39	PPI. 1923.02.0039	Prof. Dr. H. Jaja Jahari, M.Pd.	UIN Sunan Gunung Djati Bandung
40	PPI. 1923.02.0040	Prof. Dr. Imam Makruf, S.Ag. M.Pd.	UIN Raden Mas Said Surakarta
41	PPI. 1923.02.0041	Nur kolis, Ph.D	IAIN Ponorogo
42	PPI. 1923.02.0042	Moh. Khalilullah, S.Ag., MA.	UIN Sultan Syarif Kasim Riau
43	PPI. 1923.02.0043	Dr. Barowi, M.Ag.	UNISNU JEPARA
44	PPI. 1923.02.0044	Dr. Eddi Supriadi, M.SI., Ph.D.	STIT Nusantara Bekasi
45	PPI. 1923.02.0045	Dr. Rofiq Faudy Akbar, M.Pd.	IAIN Kudus
46	PPI. 1923.02.0046	Dr. H. Masduki, M.Ag.	IAIN Tulungagung
47	PPI. 1923.02.0047	Dr. Widyanti Herdyaningrum, S.Pd.I., M.Pd.	STAI Denpasar Bali
48	PPI. 1923.02.0048	Dr. Supardi, M.Pd. Ph.D.	UIN Sultan Maulana Hasanudin Banten
49	PPI. 1923.02.0049	Dr. Abd. Aziz Hsb, M.Pd.	UIN Syarif Hidayatullah Jakarta
50	PPI. 1923.02.0050	Dr. Hary Priatna Sanusi, M.Ag.	UIN Sunan Gunung Djati Bandung
51	PPI. 1923.02.0051	Dr. Yusup Rohmadi, M.Hum	IAIN Surakarta
52	PPI. 1923.02.0052	Dr. Hj. Ni’matus Sholihah, M.Ag.	UIN Sunan Ampel Surabaya
53	PPI. 1923.02.0053	Nasril, S.Pd.I., M.Pd.I	STAI Syeh Maulana Qori Bangko Jambi
54	PPI. 1923.02.0054	Dr. Lian G. Otaya, M.Pd.	IAIN Sultan Amai Gorontalo
55	PPI. 1923.02.0055	Dr. Safriadi, M.Pd.	UIN Ar-Raniry Aceh
56	PPI. 1923.02.0056	Muhammad Idris, M.Pd.I	STIT Pringsewu Lampung
57	PPI. 1923.02.0057	Dr. Rada, M.Pd.I	IAIN SAS Bangka Belitung
58	PPI. 1923.02.0058	Prof. Dr. Zubaidi, M.Pd.	UNISNU Jepara
59	PPI. 1923.02.0059	Hambali, M.Pd.	Universitas Nurul Jadid Paiton
60	PPI. 1923.02.0060	Dr. dr. T. D. E. Abeng, M.Kes.	IAIN Manado
61	PPI. 1923.02.0061	Dr. Abu Choir, MA.	IAIN Kudus
62	PPI. 1923.02.0062	Dr. Dadan F. Ramdhan, M .Ag., M.M.Pd	UIN Sunan Gunung Djati Bandung
63	PPI. 1923.02.0063	Dr. H. Muh. Khoirul Rifa'i, M.Pd.I	UIN Sunan Ampel Surabaya
64	PPI. 1923.02.0064	Dr. Saefrudin, M.Pd.I	STISFA Kediri
65	PPI. 1923.02.0065	Prof. Dr. Tien Rafida, M.Hum	UIN Sumatera Utara Medan
66	PPI. 1923.02.0066	Prof. Dr. Zamroni, M.Pd.	IAIN Samarinda
67	PPI. 1923.02.0067	Mustari, P.hD	Kemendikbud RI
68	PPI. 1923.02.0068	Dr. Hj. Eneng Muslihah, P.hD	UIN Sultan Maulana Hasanudin Banten
69	PPI. 1923.02.0069	Prof. Dr. Mubin Noho, S.Ag., M.Ag.	IAIN Ternate
70	PPI. 1923.02.0070	Dr. Hefni Razak, M.Pd.	Universitas Nurul Jadid Paiton
71	PPI. 1923.02.0071	Prof Dr. Astuti, S.Ag.,M.Pd.	IAIN Bone
72	PPI. 1923.02.0072	Prof Dr. Asep Kurniawan, M.Ag.	IAIN Syekh Nurjati Cirebon
73	PPI. 1923.02.0073		STAI Al-Ma’arif Way Kanan Lampung
74	PPI. 1923.02.0074	Dr. H. Saiful Hadi, M.Ag.	IAIN Madura
75	PPI. 1923.02.0075	H. Dendi Yuda S., M.Ag.	IAIC Tasikmalaya
76	PPI. 1923.02.0076	Dr. Imam Subhi, M.Pd.I	STIT Pagaralam Palembang
77	PPI. 1923.02.0077	Dr. H. Asep Encu, M.Pd.	UIN Sunan Gunung Djati Bandung
78	PPI. 1923.02.0078	Dr. H. Ohan Burhan, M.Pd.I	Kanwil Kemenag Provinsi Jawa Barat
79	PPI. 1923.02.0079	Dr. H. Akhmad Buhaiti, M.Si.	Kemenag Kab. Pangandaran
80	PPI. 1923.02.0080	Dr. Muhammad Hori, M.Ag.	UNINUS Bandung
81	PPI. 1923.02.0081	Dr. H. Najib Kusnanto, S.Ag., M.Si	Kamenag Kab. Pasuruan Jawa Timur
82	PPI. 1923.02.0082	Shorihatul Inayah, S.Pd.	MAN 1 Tuban
83	PPI. 1923.02.0083	Dr. Ahmad Ripai, M.Pd.	IAIN Syekh Nur Jati Cirebon
84	PPI. 1923.02.0084	Dr. Ardianto Tola, M.Pd.	IAIN Manado
85	PPI. 1923.02.0085	Drs. H. Ali Nurdin, M.Pd.	UIN Syarif Hidayatullah Jakarta
86	PPI. 1923.02.0086	Dr. Abdul Kholik, M.Pd.I	Universitas Djuanda Bogor
87	PPI. 1923.02.0087	Zulkipli, M.Pd.I	UM Palembang
88	PPI. 1923.02.0088	Cepi Budiyanto, M.Pd.I	STIT Al-Ihsan Baleendah Bandung
89	PPI. 1923.02.0089	Dr. Lilis Kholisoh Nuryani, S.Ag., M.Pd.	STAI Al-Ma’arif Ciamis
90	PPI. 1923.02.0090	Dr. H. Wahyu Hidayat, MA.	UIN Sunan Gunung Djati Bandung
91	PPI. 1923.02.0091	Prof. Dr. Fahruroji, M.Ag.	UIN Walisongo Semarang
92	PPI. 1923.02.0092	Jumari, M.Pd.	STAI Denpasar Bali
93	PPI. 1923.02.0093	Mumtazul Fikri, S.Pd.I, MA.	UIN Ar-Raniry Aceh
94	PPI. 1923.02.0094	Nunu Mahnun, S.Ag., M.Pd. Ph.D	UIN Sultan Syarif Kasim Riau
95	PPI. 1923.02.0095	Prof. Dr. Muchammad Eka Mahmud, M.Ag.	IAIN Samarinda
96	PPI. 1923.02.0096	Dr. Jasiah, M.Pd.	IAIN Palangkaraya
97	PPI. 1923.02.0097	Elfridawati Mai Dhuhani, M.Pd.	IAIN AMBON
98	PPI. 1923.02.0098	Dr. Mukhammad Abdullah, M.Ag.	IAIN Kediri
99	PPI. 1923.02.0099	Sarifudin, S.Pd.I., M.Si.	STAI Al-Hidayah Bogor
100	PPI. 1923.02.0100	H. Nur Kholis, Lc., M.H.I	STAI Al-Fithrah Surabaya
101	PPI. 1923.02.0101	Dr. H. Ali Nurhadi, S.Pd., M.Pd.	IAIN Madura
102	PPI. 1923.02.0102	Dr. Hilal Mahmud, M.M	IAIN Palopo
103	PPI. 1923.02.0103	Dr. Hj. Jumira Warlizasusi, M.Pd	IAIN Curup
104	PPI. 1923.02.0104	Prof. Dr. H. Hasan Baharun, M.Pd.	Universitas Nurul Jadid
105	PPI. 1923.02.0105	Ainur Alam Budi Utomo, S.Pd.I., M.Si., M.Pd.	Universitas Buana Perjuangan Karawang
106	PPI. 1923.02.0106	Agus Triono, S.Sos.I, M.Pd.I	STAI YASBA Kalianda Lampung
107	PPI. 1923.02.0107	Hilmi Qosim Mubah, M.Pd.I	IAIN Madura
108	PPI. 1923.02.0108	Mustajib, M.Pd	IAIFA Kediri
109	PPI. 1923.02.0109	Dr. H. Mukhamad Ilyasin, M.Pd.	IAIN Samarinda
110	PPI. 1923.02.0110	Dr. H. Saidil Mustar, M.Pd	IAIN Curup
111	PPI. 1923.02.0111	Mahfud Ifendi, M.Pd.I	STAI Sangata
112	PPI. 1923.02.0112	Ahmad Zaki M.Pd	STAI Jam'iyah Mahmudiyah Tanjung Pura
113	PPI. 1923.02.0113	Prof. Dr. H. A. Rusdiana, M.M.	UIN Sunan Gunung Djati Bandung
114	PPI. 1923.02.0114	Dr. Abdillah, M.Pd.	UIN Sumatera Utara Medan
115	PPI. 1923.02.0115	Dr. H. Acep Nurlaeli, M.Ag.	Universitas Singaperbangsa Karawang
116	PPI. 1923.02.0116	Dr. Imron Muttaqin, S.Pd.I, M.Pd.I	IAIN Pontianak
117	PPI. 1923.02.0117	Dr. Hj. Lailial Muhtifah, M. Pd	IAIN Pontianak
118	PPI. 1923.02.0118	Muhamad Taufik BK, S.Pd.I., M.Pd.	Universitas Singaperbangsa Karawang
119	PPI. 1923.02.0119	Muhamad Kosim, S.Pd.I.,M.Pd.	STIT Qurrota A'yun Garut
120	PPI. 1923.02.0120	Dr. Dewinofrita, S.Pd.I. M.Pd	IAIN Ambon
121	PPI. 1923.02.0121	Aisyah Dana Luwihta	STAI Hasan Jufri Bawean Gresik
122	PPI. 1923.02.0122	Nurul Huda	STAI Hasan Jufri Bawean Gresik
123	PPI. 1923.02.0123	Defi Dachlian Nurdiana, M.Si	STAI Hasan Jufri Bawean Gresik
124	PPI. 1923.02.0124	Patsun	STAI Hasan Jufri Bawean Gresik
125	PPI. 1923.02.0125	Mohammad Adnan	STAI Hasan Jufri Bawean Gresik
126	PPI. 1923.02.0126	Muwafiqus Shobri	STAI Hasan Jufri Bawean Gresik
127	PPI. 1923.02.0127	Moh. Harun Al Rosid, M. Pd. I	IAI Darussalam Blokagung Banyuwangi
128	PPI. 1923.02.0128	Dr. Rijal Firdaos, M. Pd	UIN Sultan Maulana Hasanudin Banten
129	PPI. 1923.02.0129	Daud Nurdin, MH.	PP. Al-Ittifaq Ciwidey Soreang Bandung
130	PPI. 1923.02.0130	Dr. Khairuddin, M.Ag.	UIN Sumatera Utara Medan
131	PPI. 1923.02.0131	Dr. Makmur Syukri. M.Pd	UIN Sumatera Utara Medan
132	PPI. 1923.02.0132	Dr. Yusuf Hadijaya, MA.	UIN Sumatera Utara Medan
133	PPI. 1923.02.0133	Dr. Neliwati, M.Pd.	UIN Sumatera Utara Medan
134	PPI. 1923.02.0134	Dr. H. Moh. Anwar, M.Pd.	UIN Kiai Achmad Siddiq Jember
135	PPI. 1923.02.0135	Dr. H. Ahmad Aziz Fanani, M.Pd.I	IAI Ibrahimy Genteng Banyuwangi
136	PPI. 1923.02.0136	Dr. H. Kholilur Rahman, M.Pd.I	IAI Ibrahimy Genteng Banyuwangi
137	PPI. 1923.02.0137	Dr. Haya, S.HI, M.Pd.I	UBI Banyuwangi
138	PPI. 1923.02.0138	Dr. Syuhud, M.Pd.I	IAI Syarifuddin Lumajang
139	PPI. 1923.02.0139	Dr. Muhamad Arifin, M.Pd	STIS Darul Falah Mataram NTB
140	PPI. 1923.02.0140	Dr. Imron Fauzi, M.Pd.I	UIN Kiai Achmad Siddiq Jember
141	PPI. 1923.02.0141	Dr. Yudi Ardian Rahman, M.Pd.I	STIT Al-Ishlah Bondowoso
142	PPI. 1923.02.0142	Dr. Atep Suherman, S.Pd. M.Pd.	Dinas Pendidikan Kab. Garut
143	PPI. 1923.02.0143	Sayan Suryana, S.Sos., M.M.	Universitas Singaperbangsa Karawang
144	PPI. 1923.02.0144	Dr. Ilham Fahmi, M.Pd.	Universitas Singaperbangsa Karawang
145	PPI. 1923.02.0145	H. Asep Jajuli, M.Pd.	UIN Sunan Gunung Djati Bandung
146	PPI. 1923.02.0146	Dr. Eti Hariyati, M.Pd	SMP Negeri 5 Bandung
147	PPI. 1923.02.0147	Dr. Ramzi Murziqin, S.H.I., M.A.	UIN Ar-Raniry Aceh
148	PPI. 1923.02.0148	Dr. Tabrani, ZA., S.Pd.I., M.S.I., MA.	Univ. Serambi Mekkah Banda Aceh
149	PPI. 1923.02.0149	Heru Juabdin Sada, M.Pd.I	UIN Raden Intan Lampung
150	PPI. 1923.02.0150	Dr. Junaidah, M.Pd.I	UIN Raden Intan Lampung
151	PPI. 1923.02.0151	Dr. H. Ahmad Qurtubi, MA.	UIN Sultan Maulana Hasanudin Banten
152	PPI. 1923.02.0152	Kenny Agusto Arie Wibowo, M.Pd.	Institut Agama Islam Daar Al Uluum Asahan
153	PPI. 1923.02.0153	Alwizra, S.Pd.I., M.Pd.	STAI YAPTIP Pasaman Barat
154	PPI. 1923.02.0154	Dr. Awaludin Hamzah	Subang
155	PPI. 1923.02.0155	Dr. H. Dodo Murtado, M.Si.	IAIC Tasikmalaya
156	PPI. 1923.02.0156	Dr. Ahmad Royani, M.Pd.I	UIN Kiai Haji Achmad Siddiq Jember
157	PPI. 1923.02.0157	Dr. Ratu Vina Rohmatika, M. Pd.	IAIN METRO
158	PPI. 1923.02.0158	Rayan Nurdin, M.Pd	UIN Sunan Gunung Djati Bandung
159	PPI. 1923.02.0159	Jiwa Marisya Amsor, M.Pd	UIN Sunan Gunung Djati Bandung
160	PPI. 1923.02.0160	Prof. Dr. Hj. Aan Komariah, M.Pd	UNIVERSITAS PENDIDIKAN INDONESIA
161	PPI. 1923.02.0161	Prof. Dr. Zainal Arifin, M.SI	UIN Sunan Gunung Djati Bandung
162	PPI. 1923.02.0162	Dr. H. Cece Hidayat. M.Si	Kemenag kab. Bandung
163	PPI. 1923.02.0163	Deti Elice, M.Pd.	UIN Raden Intan Lampung
164	PPI. 1923.02.0164	Dr. Hj. Atiyah Suharti., M.Pd.	Balai Dklat Keagamaan Bandung
165	PPI. 1923.02.0165	Dr. yusnaili Budianti, M. Ag	UINSU Medan
166	PPI. 1923.02.0166	Evi Amalia Setya Ningtyas, S.Pd., M.Pd	SMAN 1 Pekalongan. Lampung Timur
167	PPI. 1923.02.0167	Dr. H. Aep Tata Suryana, SHI,MM	UIN Sunan Gunung Djati Bandung
168	PPI. 1923.02.0168	Hosaini, S.Pd.I, M.Pd	Universitas Bondowoso
169	PPI. 1923.02.0169	Yanti Nurdiyanti, S.Pd.I,MM	Sekolah Tinggi Ilmu Tarbiyah Nahdlatul Ulama (STITNU) Al-Farabi Pangandaran
170	PPI. 1923.02.0170	Dr. Azizah Hanum OK, M.Ag	
171	PPI. 1923.02.0171	Dr. Karjianto, S.Pd.I., M.Pd.	
172	PPI. 1923.02.0172	H. Suhelmon, MA	
173	PPI. 1923.02.0173	Muhamad Faizin, S.Pd., M.Pd.	
174	PPI. 1923.02.0174	Dr. Junaidi Arsyad, MA	
175	PPI. 1923.02.0175	Prof. Dr.Mesiono.S Ag.M.Pd	
176	PPI. 1923.02.0176	Dr. Ahmadi, S.Ag., M.S.I.	
177	PPI. 1923.02.0177	Prof.Dr. Rusdy Ananda, M.Pd	
178	PPI. 1923.02.0178	Kenny Agusto Arie Wibowo, M.Pd	
179	PPI. 1923.02.0179	Prof. Dr. Muhammad Thoyib, M.Pd	
180	PPI. 1923.02.0180	Dr. K.H. Saiful Hadi, M.Pd	
181	PPI. 1923.02.0181	Abu Amar Bustomi, M.Si	
182	PPI. 1923.02.0182	Suadi, S.Ag, M.Pd.I	
183	PPI. 1923.02.0183	Dr. H. Hasbiyallah, M. Ag	
184	PPI. 1923.02.0184	Prof. Dr.Siswanto, M.Pd.I	
185	PPI. 1923.02.0185	Prof. Dr. Musthofa, M.Ag.	
186	PPI. 1923.02.0186	Agus Eka Hamdani, S.Ag, M.M.Pd	
187	PPI. 1923.02.0187	Dr. Ahmad Rifai	
188	PPI. 1923.02.0188	Prof. Dr. H. Hasan Baharun, M.Pd	
189	PPI. 1923.02.0189	Dr. Amirudin, S.Fil.I., MM	Universitas Islam Bunga Bangsa Cirebon
190	PPI. 1923.02.0190	Prof. Dr. Fahrurrozi, M.Ag	
191	PPI. 1923.02.0191	Prof. Dr. Fahim Taroba	
192	PPI. 1923.02.0192	Prof. Wahid Murni	
193	PPI. 1923.02.0193	Dr. H. Mubin Noho, M.Ag	
194	PPI. 1923.02.0194	Prof. Dr. Bambang Samsul Arifin, M. Si	Universitas Islam Sunan Gunung Djati
195	PPI. 1923.02.0195	Dr. Yuli Marlina,S.Pd.,M.Pd	Universitas Islam Jakarta
196	PPI. 1923.02.0196	Dr. H. A.Bazari Syam, M.Pd.I.	UIN SULTAN MAULANA HASANUDDIN BANTEN
197	PPI. 1923.02.0197	Shorihatul Inayah, S.Pd., M.Si.	MAN 1 Tuban
198	PPI. 1923.02.0198	Dr. Wahyu Hidayat, MA	UIN Sunan Gunung Djati Bandung
199	PPI. 1923.02.0199	Dr. Irwan Fathurrochman, S.Pd.I., M.Pd	Institut Agama Islam Negeri Curup
200	PPI. 1923.02.0200	Saprialman, S.Pd.I., M.Pd., CHt	Universitas Singaperbangsa Karawang
201	PPI. 1923.02.0201	Cepi Budiyanto, M.Pd	STIT Al-Ihsan Baleendah Bandung
202	PPI. 1923.02.0202	Prof. Dr. Karman, M.Ag., CHS	UIN SGD Bandung
203	PPI. 1923.02.0203	Dr. Samrin, M. Pd. I	IAIN Kendari
204	PPI. 1923.02.0204	Elfridawati Mai Dhuhani, M.Pd	IAIN Ambon
205	PPI. 1923.02.0205	Dr. Muhammad Rifa'i, M.Pd	UIN Sumatera Utara Medan
206	PPI. 1923.02.0206	Dr. Hartono, M.Pd.	FTIK UIN Kiai Haji Achmad Siddiq Jember
207	PPI. 1923.02.0207	Abdul Kholik, M.Pd.I	Universitas Djuanda
208	PPI. 1923.02.0208	Prof. Muhammad Munadi, S.Pd., M.Pd	Universitas Islam Negeri Raden Mas Said Surakarta
209	PPI. 1923.02.0209	Dr. Hj. Nurul Hidayati Murtafiah, M. Pd. I	Universitas Islam An Nur Lampung
210	PPI. 1923.02.0210	Dr. H. Andi Warisno, M. MPd	Universitas Islam An Nur Lampung
211	PPI. 1923.02.0211	Dr. H. Susilo Surahman, S.Ag., M.Pd.	Fakultas Ilmu Tarbiyah UIN Raden Mas Said Surakarta
212	PPI. 1923.02.0212	Muh Barid Nizarudin Wajdi	STAI Miftahul Ula Nganjuk
213	PPI. 1923.02.0213	Dr. H. Aep Saepurohman, S.Ag., M.S.i, MCE	STIT Az-ZahraTasikmalaya
214	PPI. 1923.02.0214	H. Asep Abdullah, SE., MM., M. Pd.	Yayasan Miftahul Ulum
215	PPI. 1923.02.0215	Dr. Sandra Taufik Hidayat, M.Ag	BAN PDM (Badan Akreditasi Nasional ) PAUD, DASAR DAN MENENGAH PROV. Jawa Barat
216	PPI. 1923.02.0216	Dr. H. YAYAT SUDRAJAT, M.Pd	MAN 1 BANDUNG
217	PPI. 1923.02.0217	Dr. H. NIFASRI, M.Pd	UIN Sunan Gunung Djati Bandung
218	PPI. 1923.02.0218	Nur Kolis, S.Ag., M.Ag., Ph.D.	Pascasarjana IAIN Ponorogo
219	PPI. 1923.02.0219	Dr. Siti Khoirun Nisak, S.Pd.I., M.Pd.	UIN Sayyid Ali Rahmatullah Tulungagung
220	PPI. 1923.02.0220	Dr. H. Indah Komsiyah, S,Ag., MPd	UIN Sayyid Ali Rahmatullah Tulungagung
221	PPI. 1923.02.0221	Dr. Indah Wahyu Ningsih, M.Pd	STAI Al-Hidayah Bogor
222	PPI. 1923.02.0222	Dr. H. Taufik, MM., MPd.	STAI AL HIKMAH JAKARTA
223	PPI. 1923.02.0223	Baqiyatush Sholihah, S.Th.I., M.Si.	UIN Walisongo Semarang
224	PPI. 1923.02.0224	Dr. Hj. Cici Handritin, S.Sos.I.,M.Pd	Yayasan Nurul Hidayah
225	PPI. 1923.02.0225	Dr.H.Ojak Manurung,S.Ag.,SH.,SE.,M.Pd.,MH.,MM	UIN Sumatera Utara
226	PPI. 1923.02.0226	Dr. Mona Novita, M.Pd.	Institut Agama Islam Yasni Bungo
227	PPI. 1923.02.0227	Prof. Dr. H. Atiqullah, S.Ag., M.Pd	IAIN MADURA
228	PPI. 1923.02.0228	Ilham Agustian Widia Yusuf	STAI DARUSSALAM KUNIR
229	PPI. 1923.02.0229	Dr. H. Badrud Tamam, S.Sos., M.Pd.	Pascasarjana Universitas Wiralodra
230	PPI. 1923.02.0230	Andre Ariesmansyah, S.AP., M.AP.	Universitas Pasundan
231	PPI. 1923.02.0231	Ade Suryadi, S.Sos.I., M.Pd 	Universitas Islam KH. Ruhiat cipasung
232	PPI. 1923.02.0232	Dr. Rudiana, S.Th.I, M.Pd	Pascasarjana (S2) MPI Universitas Islam KH Ruhiat Cipasung
233	PPI. 1923.02.0233	Dr. IIS SUHAYATI, M.Ag	UNIVERSITAS KH RUHIAT CIPASUNG SINGAPARNA TASIKMALAYA
234	PPI. 1923.02.0234	Dr. H. Buhori M. S.Sos.I, M.Ag	UNIVERSITAS KH RUHIAT CIPASUNG SINGAPARNA TASIKMALAYA
235	PPI. 1923.02.0235	Heru Nugraha, M.Pd.I	UNIVERSITAS KH RUHIAT CIPASUNG SINGAPARNA TASIKMALAYA
236	PPI. 1923.02.0236	Dr. H. Endang Solihin, M.Si.	UNIVERSITAS KH RUHIAT CIPASUNG SINGAPARNA TASIKMALAYA
237	PPI. 1923.02.0237	M. Aqil Baihaqi,S.Ag.,M.Sos	UIN Sunan Gunung Djati Bandung
238	PPI. 1923.02.0238	Prof. Dr. Dedy Achmad Kurniady, M.Pd.	Administrasi Pendidikan FIP UPI
239	PPI. 1923.02.0239	Dr. Eti Jumiati, SE.,MM	STAI Al-Muhajirin Purwakarta
240	PPI. 1923.02.0240	Dr. Sarwo Edy, S.Ag., M.M.	Fakultas Ilmu Keguruan dan Tarbiyah Universitas Pelita Bangsa
241	PPI. 1923.02.0241	Drs. Wawan Purnama, M.Si	FPTI UPI
242	PPI. 1923.02.0242	Muhammad Bisyri, M.Pd.	Institut Daarul Qur'an Jakarta
243	PPI. 1923.02.0243	Dr. Rada, M.Pd.I	IAIN SAS Bangka Belitung
244	PPI. 1923.02.0244	Dr. Atep Suherman, M. Pd.	SDN 2 Garumukti
245	PPI. 1923.02.0245	Gita Hanina, S.Pd, M.Pd.	UIN Raden Intan Lampung
246	PPI. 1923.02.0246	Waode Muslia, S.E, M.H	Biddokkes Polda Lampung
247	PPI. 1923.02.0247	Ferunika,SE.M.Si	Loka Diklat Keagamaan Bandar Lampung
248	PPI. 1923.02.0248	Yeni Astuti, S.Pd.,M.Si	LDK Bandar Lampung
249	PPI. 1923.02.0249	Sunyamin, S.Pd.I, Gr., M.Pd.	SMAN 1 PEMATANG SAWA
250	PPI. 1923.02.0250	Denti Septi Aria Sandy, M.Pd	Pascasarjana UIN Raden Intan Lampung
251	PPI. 1923.02.0251	Saiful Bahri, M.Pd.I	UIN Raden Intan Lampung
252	PPI. 1923.02.0252	Fitriani, S.IQ., S.Pd.I., M.Pd.I.	Universitas Islam Negeri Raden Intan Lampung
253	PPI. 1923.02.0253	Ahmad Faisol Ansori, SE., M.S.Ak., CPSp., CCMS	UIN Raden Intan Lampung
254	PPI. 1923.02.0254	Rd. Roro Atmim Nurona, M.Pd	UIN Raden Intan Lampung
255	PPI. 1923.02.0255	Supriadi, S.Pd, M.Pd	Mts Diniyyah Putri Lampung
256	PPI. 1923.02.0256	Agus Faisal Asyha, M.Pd.I.	UIN Raden Intan Lampung
257	PPI. 1923.02.0257	Eko Widiyanto, M.Pd	Dinas pendidikan dan kebudayaan kab. Mesuji
258	PPI. 1923.02.0258	Prof. Dr. Abdurrahman. M.Pd	FITK UIN SU Medan
259	PPI. 1923.02.0259	Mustofa, S.Pd.I, M.Pd.I.	SMPN 2 Rawajitu Selatan
260	PPI. 1923.02.0260	Khoiriya Ulfah, MA	UIN Raden Intan Lampung
261	PPI. 1923.02.0261	AGUS MUNAWAR, S.Pd.I, M.Pd.I	DPRD Mesuji
262	PPI. 1923.02.0262	Dr. Jasiah, S.Ag, M.Pd	IAIN Palangkaraya
263	PPI. 1923.02.0263	Mohamad Mustari, MM.,MA.,Ph.D	
264	PPI. 1923.02.0264	Hj. Lala Tansah, S.Si., M.Pd.	
265	PPI. 1923.02.0265	Nova Sariwati, M.Si	
266	PPI. 1923.02.0266	Dr.H.Enjang Yusup Ali,S.Si.,M.Kom.,M.CE.	Universitas Pendidikan Indonesia (Sumedang)
267	PPI. 1923.02.0267	Dendy Maulana Gusmawan, M.Pd.	
268	PPI. 1923.02.0268	Della Hanifah Nurbaeti, M.Pd	
269	PPI. 1923.02.0269	Ivan Fanani Qomusuddin	
271	PPI. 1923.02.0271	Siti Latifah	
272	PPI. 1923.02.0272	Cucu Munawaroh, M.Pd	
273	PPI. 1923.02.0273	Dwi Ajeng Maulidya Makalao	
274	PPI. 1923.02.0274	G. Ginanjar Masruri	
275	PPI. 1923.02.0275	Dr. M. Wafiyul Ahdi, M.Pd.I	
276	PPI. 1923.02.0276	Dr. Abdulloh Hamid, M.Pd.	
277	PPI.1923.02.0277	Prof. Dr. H. Masturin, S.Ag, M.Ag	
278	PPI.1923.02.0278	Dr. Dadang Zenal Mutaqin, M.Pd.	
279	PPI.1923.02.0279	Prof. Dr. H. Budiman, MSi, MM	
280	PPI.1923.02.0280	Nita Anjung Munggaran, M.Pd	
281	PPI.1923.02.0281	Dr. Ade Een Khaeruniah, M.Ag	
282	PPI.1923.02.0282	Dr. Hj. Astri Riani Dewi, S.Pd.,M.Si.	
283	PPI.1923.02.0283	Dr.Hj.Nur Irsyadiah,M.Pd.I	
284	PPI.1923.02.0284	Dr. Euis Latipah, M.Pd	
285	PPI.1923.02.0285	Dr. H. Nur Khoiri, M.Ag	
286	PPI.1923.02.0286	Dr. Siti Julaiha, S.Ag.M.Pd	
287	PPI. 1923.02.0287	Dr.H.Cece,S.Ag,M.Ag,C.SQ,CT	
288	PPI. 1923.02.0288	Dr. Hj. Siti Choiriyah, M.Ag.	
289	PPI. 1923.02.0289	Dr. Hakiman, M.Pd.	
290	PPI. 1923.02.0290	Dr. Heldy Ramadhan Putra P., M.Pd	
291	PPI. 1923.02.0291	Prof. Dr. Fauzi Muharom, M.Ag.	
292	PPI. 1923.02.0292	Pratiwi Rahmah Hakim, M. Pd.	
293	PPI. 1923.02.0293	Muhammad Zaenuri, M.Pd	
294	PPI. 1923.02.0294	Muhammad Irfan Syaifuddin, M.H.I.	
295	PPI. 1923.02.0295	Dr. Hj. Euis Damayanti, M.P.Kim.	
296	PPI. 1923.02.0296	Dr. Hj. Waqiatul Masrurah, M.Si	
297	PPI. 1923.02.0297	Dr. Indah Kusuma Dewi, M.Pd.I.	
298	PPI. 1923.02.0298	Dr. Nurul Yaqien, S.Pd.I, M.Pd	
EOD;

        $lines = explode("\n", $raw);
        foreach ($lines as $line) {
            $parts = explode("\t", trim($line));
            if (count($parts) < 3) continue;

            $no = trim($parts[0]);
            $kta = trim($parts[1]);
            $name = trim($parts[2]);
            $unit = isset($parts[3]) ? trim($parts[3]) : '';

            if (empty($kta) || empty($name)) continue;

            // Generate unique username and placeholder email using KTA suffix
            $ktaClean = str_replace([' ', '.', '-'], '', $kta); // e.g. PPI1923020001
            $username = strtolower($ktaClean);
            $email = strtolower($ktaClean) . '@permapendis.id';

            // Check if profile or user already exists to avoid duplication
            $existingProfile = UserProfile::where('member_number', $kta)->first();
            if ($existingProfile) {
                continue;
            }

            // Create profile
            $profile = UserProfile::create([
                'name'              => $name,
                'email'             => $email,
                'member_number'     => $kta,
                'institution'       => $unit,
                'membership_status' => 'aktif',
                'kta_issued_at'     => now(),
            ]);

            // Create user login credentials
            User::create([
                'username'        => $username,
                'password'        => Hash::make('perma123'),
                'role_id'         => 3, // Default: User
                'user_profile_id' => $profile->id,
                'is_activated'    => true,
            ]);
        }
    }
}
