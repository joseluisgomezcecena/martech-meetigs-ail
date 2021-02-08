using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Net;
using System.IO;

namespace ailTrigger
{
	class Program
	{
		static void Main(string[] args)
		{
			var webClient = new WebClient();
			webClient.DownloadString("http://192.168.7.133/ail/ailApp/_packages/notifications.php");
		}
	}
}
