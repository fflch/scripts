select wc.form_key, wsd.sid, wsd.data 
from webform_component wc
left join webform_submitted_data wsd
on (wc.cid = wsd.cid)
where wc.nid=31 and wsd.nid=31
order by wsd.sid;

select fid, filename
from file_managed fm 
